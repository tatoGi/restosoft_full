<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\Post;
use App\Models\PostFile;
use App\Models\PostTranslation;
use App\Models\Section;
use App\Models\Slug;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index($sec)
    {
        $section = Section::where('id', $sec)->with('translations')->first();

        if (isset($section->type) && in_array($section->type['type'], [7, 3, 2])) {
            $post = Post::where('section_id', $sec)->with(['translations', 'slugs'])->first();
            if (isset($post) && $post !== null) {
                return Redirect::route('post.edit', [app()->getLocale(), $post->id]);
            }

            return Redirect::route('post.create', [app()->getLocale(), $sec]);
        }
        $posts = Post::where('section_id', $sec)->orderBy('date', 'desc')->orderBy('created_at', 'asc')
        ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
        ->where('post_translations.locale', '=', app()->getLocale())

        ->select('posts.*', 'post_translations.text', 'post_translations.desc', 'post_translations.title', 'post_translations.locale_additional', 'post_translations.slug');

        $posts = $posts->with(['translations', 'slugs'])->paginate(settings('Paginate'));

        return view('admin.posts.list', compact(['section', 'posts']));
    }

    public function create($sec)
    {
        $section = Section::where('id', $sec)->with('translations')->first();

        return view('admin.posts.add', compact(['section']));
    }

    public function store($sec, Request $request)
    {
        $section = Section::where('id', $sec)->with('translations')->first();
        $values = $request->all();
        $values['section_id'] = $sec;
        $values['author_id'] = auth()->user()->id;
        $postFillable = (new Post)->getFillable();
        $postTransFillable = (new PostTranslation)->getFillable();

        // Handle thumb image upload
        if ($request->hasFile('thumb')) {
            try {
                $thumb = $request->file('thumb');
                if ($thumb->getSize() > 2097152) {
                    return redirect()->back()->with('error', 'Thumb image size is greater than 2MB.');
                }

                // Validate file type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($thumb->getMimeType(), $allowedTypes)) {
                    return redirect()->back()->with('error', 'Invalid image type. Only JPG, PNG and GIF are allowed.');
                }

                $newThumbName = uniqid().'.'.$thumb->getClientOriginalExtension();
                $thumb->move(config('config.image_path'), $newThumbName);
                $values['thumb'] = $newThumbName;

                // Delete old thumb if exists
                if (isset($values['old_thumb']) && Storage::exists(config('config.image_path').'/'.$values['old_thumb'])) {
                    Storage::delete(config('config.image_path').'/'.$values['old_thumb']);
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error uploading thumb image: ' . $e->getMessage());
            }
        } elseif (isset($values['old_thumb'])) {
            $values['thumb'] = $values['old_thumb'];
        }

        // Handle non-translatable icon
        if (isset($values['icon']) && ($values['icon'] != '')) {
            try {
                if ($values['icon']->getSize() > 2097152) {
                    return redirect()->back()->with('error', 'Icon file size is greater than 2MB.');
                }
                $newiconName = uniqid().'.'.$values['icon']->getClientOriginalExtension();
                $values['icon']->move(config('config.file_path'), $newiconName);
                $values['icon'] = $newiconName;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error uploading icon: ' . $e->getMessage());
            }
        } elseif (isset($values['old_icon'])) {
            $values['icon'] = $values['old_icon'];
        }

        $values['additional'] = getAdditional($values, array_diff(array_keys($section->fields['nonTrans']), $postFillable));

        foreach (config('app.locales') as $locale) {
            // Handle slug - if not provided, create from title
            if (!isset($values[$locale]['slug']) || empty($values[$locale]['slug'])) {
                $values[$locale]['slug'] = str_replace(' ', '-', $values[$locale]['title']);
            } else {
                $values[$locale]['slug'] = str_replace(' ', '-', $values[$locale]['slug']);
            }

            // Handle file upload
            if (isset($values[$locale]['file']) && $values[$locale]['file'] != '') {
                try {
                    if ($values[$locale]['file']->getSize() > 2097152) {
                        return redirect()->back()->with('error', 'File size is greater than 2MB.');
                    }
                    $newfileName = uniqid().'.'.$values[$locale]['file']->getClientOriginalExtension();
                    $orignalName = $values[$locale]['file']->getClientOriginalName();
                    $values[$locale]['file']->move(config('config.file_path'), $newfileName);
                    $values[$locale]['file'] = $newfileName;
                    $values[$locale]['filename'] = $orignalName;

                    // Delete old file if exists
                    if (isset($values[$locale]['old_file'])) {
                        Storage::delete(config('config.file_path').$values[$locale]['old_file']);
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading file for ' . $locale . ': ' . $e->getMessage());
                }
            }

            // Handle image upload
            if (isset($values[$locale]['image']) && $values[$locale]['image'] != '') {
                try {
                    if ($values[$locale]['image']->getSize() > 2097152) {
                        return redirect()->back()->with('error', 'Image size is greater than 2MB.');
                    }

                    // Validate file type
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!in_array($values[$locale]['image']->getMimeType(), $allowedTypes)) {
                        return redirect()->back()->with('error', 'Invalid image type. Only JPG, PNG and GIF are allowed.');
                    }

                    $newimageName = uniqid().'.'.$values[$locale]['image']->getClientOriginalExtension();
                    $orignalName = $values[$locale]['image']->getClientOriginalName();
                    $values[$locale]['image']->move(config('config.image_path'), $newimageName);
                    $values[$locale]['image'] = $newimageName;
                    $values[$locale]['imagename'] = $orignalName;

                    // Delete old image if exists
                    if (isset($values[$locale]['old_image'])) {
                        Storage::delete(config('config.image_path').$values[$locale]['old_image']);
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading image for ' . $locale . ': ' . $e->getMessage());
                }
            }

            $fullslug[$locale] = $locale.'/'.$values[$locale]['slug'];
            $values[$locale]['locale_additional'] = getAdditional($values[$locale], array_diff(array_keys($section->fields['trans']), $postTransFillable));
        }

        try {
            $post = Post::create($values);

            // Create translations and slugs
            foreach (config('app.locales') as $locale) {
                $post->translateOrNew($locale)->slug = $values[$locale]['slug'];
                $post->save();

                $post->slugs()->create([
                    'fullSlug' => $locale.'/'.$values[$locale]['slug'],
                    'slugable_id' => $post->id,
                    'locale' => $locale,
                ]);
            }

            // Handle additional files
            if (isset($values['files']) && count($values['files']) > 0) {
                foreach ($values['files'] as $key => $files) {
                    foreach ($files['file'] as $k => $file) {
                        try {
                            if ($file->getSize() > 2097152) {
                                return redirect()->back()->with('error', 'Additional file size is greater than 2MB.');
                            }
                            $postFile = new PostFile;
                            $postFile->type = $key;
                            $postFile->file = $file;
                            $postFile->title = $values['files'][$key]['title'][$k];
                            $postFile->file_additional = collect([
                                'ka' => $values['files'][$key]['alt_text']['ka'][$k],
                                'en' => $values['files'][$key]['alt_text']['en'][$k],
                            ]);
                            $postFile->post_id = $post->id;
                            $postFile->save();
                        } catch (\Exception $e) {
                            return redirect()->back()->with('error', 'Error uploading additional file: ' . $e->getMessage());
                        }
                    }
                }
            }

            return Redirect::route('post.list', [app()->getLocale(), $section->id]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating post: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->with(['translations', 'files'])->first();
        // dd($post);
        $section = Section::where('id', $post->section_id)->with('translations')->first();

        return view('admin.posts.edit', compact('section', 'post'));
    }

    public function update($id, Request $request)
    {
        try {
            $post = Post::where('id', $id)->with('translations', 'files')->first();
            $section = Section::where('id', $post->section_id)->with('translations')->first();

            // Delete existing slugs for the post
            Post::find($id)->slugs()->delete();

            $values = $request->all();
            $values['section_id'] = $section->id;
            $values['author_id'] = auth()->user()->id;
            $postFillable = (new Post)->getFillable();
            $postTransFillable = (new PostTranslation)->getFillable();

            // Handle thumb image upload
            if ($request->hasFile('thumb')) {
                try {
                    $thumb = $request->file('thumb');
                    if ($thumb->getSize() > 2097152) {
                        return redirect()->back()->with('error', 'Thumb image size is greater than 2MB.');
                    }

                    // Validate file type
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!in_array($thumb->getMimeType(), $allowedTypes)) {
                        return redirect()->back()->with('error', 'Invalid image type. Only JPG, PNG and GIF are allowed.');
                    }

                    $newThumbName = uniqid().'.'.$thumb->getClientOriginalExtension();
                    $thumb->move(config('config.image_path'), $newThumbName);
                    $values['thumb'] = $newThumbName;

                    // Delete old thumb if exists
                    if ($post->thumb && Storage::exists(config('config.image_path').'/'.$post->thumb)) {
                        Storage::delete(config('config.image_path').'/'.$post->thumb);
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading thumb image: ' . $e->getMessage());
                }
            } elseif (isset($values['old_thumb'])) {
                $values['thumb'] = $values['old_thumb'];
            }

            // Handle non-translatable icon
            if (isset($values['icon']) && ($values['icon'] != '')) {
                try {
                    if ($values['icon']->getSize() > 2097152) {
                        return redirect()->back()->with('error', 'Icon file size is greater than 2MB.');
                    }
                    $newiconName = uniqid().'.'.$values['icon']->getClientOriginalExtension();
                    $values['icon']->move(config('config.file_path'), $newiconName);
                    $values['icon'] = $newiconName;

                    // Delete old icon if exists
                    if ($post->icon && Storage::exists(config('config.file_path').$post->icon)) {
                        Storage::delete(config('config.file_path').$post->icon);
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error uploading icon: ' . $e->getMessage());
                }
            } elseif (isset($values['old_icon'])) {
                $values['icon'] = $values['old_icon'];
            }

            // Get additional values for non-translatable fields
            $values['additional'] = getAdditional($values, array_diff(array_keys($section->fields['nonTrans']), $postFillable));

            foreach (config('app.locales') as $locale) {
                // Handle slug - if not provided, create from title
                if (!isset($values[$locale]['slug']) || empty($values[$locale]['slug'])) {
                    $values[$locale]['slug'] = str_replace(' ', '-', $values[$locale]['title']);
                } else {
                    $values[$locale]['slug'] = str_replace(' ', '-', $values[$locale]['slug']);
                }

                // Handle file upload
                if (isset($values[$locale]['file']) && ($values[$locale]['file'] != '')) {
                    try {
                        if ($values[$locale]['file']->getSize() > 2097152) {
                            return redirect()->back()->with('error', 'File size is greater than 2MB.');
                        }
                        $newfileName = uniqid().'.'.$values[$locale]['file']->getClientOriginalExtension();
                        $values[$locale]['file']->move(config('config.file_path'), $newfileName);
                        $values[$locale]['file'] = $newfileName;

                        // Delete old file if exists
                        if ($post->translate($locale)->file && Storage::exists(config('config.file_path').$post->translate($locale)->file)) {
                            Storage::delete(config('config.file_path').$post->translate($locale)->file);
                        }
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Error uploading file for ' . $locale . ': ' . $e->getMessage());
                    }
                } elseif (isset($values[$locale]['old_file'])) {
                    $values[$locale]['file'] = $values[$locale]['old_file'];
                }

                // Handle image upload
                if (isset($values[$locale]['image']) && ($values[$locale]['image'] != '')) {
                    try {
                        if ($values[$locale]['image']->getSize() > 2097152) {
                            return redirect()->back()->with('error', 'Image size is greater than 2MB.');
                        }

                        // Validate file type
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!in_array($values[$locale]['image']->getMimeType(), $allowedTypes)) {
                            return redirect()->back()->with('error', 'Invalid image type. Only JPG, PNG and GIF are allowed.');
                        }

                        $newfileName = uniqid().'.'.$values[$locale]['image']->getClientOriginalExtension();
                        $originalName = $values[$locale]['image']->getClientOriginalName();
                        $values[$locale]['image']->move(config('config.image_path'), $newfileName);
                        $values[$locale]['image'] = $newfileName;
                        $values[$locale]['imagename'] = $originalName;

                        // Delete old image if exists
                        if ($post->translate($locale)->image && Storage::exists(config('config.image_path').$post->translate($locale)->image)) {
                            Storage::delete(config('config.image_path').$post->translate($locale)->image);
                        }
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Error uploading image for ' . $locale . ': ' . $e->getMessage());
                    }
                } elseif (isset($values[$locale]['old_image'])) {
                    $values[$locale]['image'] = $values[$locale]['old_image'];
                }

                // Update slug for this language
                $post->slugs()->updateOrCreate([
                    'locale' => $locale,
                ], [
                    'fullSlug' => $locale.'/'.$values[$locale]['slug'],
                ]);

                // Get additional values for translatable fields
                $values[$locale]['locale_additional'] = getAdditional($values[$locale], array_diff(array_keys($section->fields['trans']), $postTransFillable));
            }

            // Update the post
            $post->update($values);

            // Handle additional files
            if (isset($values['files']) && count($values['files']) > 0) {
                foreach ($values['files'] as $key => $files) {
                    foreach ($files['file'] as $k => $file) {
                        try {
                            if ($file->getSize() > 2097152) {
                                return redirect()->back()->with('error', 'Additional file size is greater than 2MB.');
                            }
                            $postFile = new PostFile;
                            $postFile->type = $key;
                            $postFile->file = $file;
                            $postFile->title = $values['files'][$key]['title'][$k];
                            $postFile->file_additional = collect([
                                'ka' => $values['files'][$key]['alt_text']['ka'][$k],
                                'en' => $values['files'][$key]['alt_text']['en'][$k],
                            ]);
                            $postFile->post_id = $post->id;
                            $postFile->save();
                        } catch (\Exception $e) {
                            return redirect()->back()->with('error', 'Error uploading additional file: ' . $e->getMessage());
                        }
                    }
                }
            }

            return redirect()->back()->with('success', 'Post updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating post: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {

        $post = Post::where('id', $id)->first();
        // foreach (Post::find($id)->slugs()->get() as $slug) {

        //     // Post::find($id)->delete();
        // }
        $section = Section::where('id', $post->section_id)->with('translations')->first();

        $files = PostFile::where('post_id', $post->id)->get();
        foreach ($files as $file) {

            if (file_exists(config('config.image_path').$file->file)) {
                unlink(config('config.image_path').$file->file);
                } else {
                dd('File does not exists.');
                }
                if (file_exists(config('config.image_path').'thumb/'.$file->file)) {
                    unlink(config('config.image_path').'thumb/'.$file->file);
                    } else {
                    dd('File does not exists.');
                    }
            $file->delete();
        }
        PostTranslation::where('post_id', $post->id)->delete();
        Post::find($id)->slugs()->delete();
        $post->delete();

        return Redirect::route('post.list', [app()->getLocale(), $section->id]);
    }

    public function DeleteFile(Request $request)
    {
        $lang = $request->lang;
        $que = $request->que;
        $post = Post::where('id', $que)->whereHas('translations', function ($q) use ($lang) {
            $q->where('locale', $lang);
        })->with('translation')->first();

        $localeAdditional = $post->$lang->locale_additional;

        if (isset($localeAdditional['image']) && file_exists(config('config.image_path').$localeAdditional['image'])) {
            unlink(config('config.image_path').$localeAdditional['image']);
            unset($localeAdditional['image']);
        }

        if (isset($localeAdditional['file']) && file_exists(config('config.file_path').$localeAdditional['file'])) {
            unlink(config('config.file_path').$localeAdditional['file']);
            unset($localeAdditional['file']);
        }

        $post->$lang->locale_additional = $localeAdditional;
        $post->save();

        return response()->json(['success' => 'Files Deleted']);
    }

         public function sendNewsletter($post)
         {
            $post = Post::where('id', $post)->with('translations', 'files')->first();

            $subscribers = Subscription::all();

            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->queue(new NewsletterMail($post));
            }

             return redirect()->back()->with('success', 'Newsletter sent successfully!');
         }

    public function deleteImage($post)
    {
        try {
            $post = Post::findOrFail($post);
            $field = request('field', 'image');

            if ($field === 'thumb') {
                // Handle thumb image deletion
                if ($post->thumb) {
                    $imagePath = config('config.image_path').'/'.$post->thumb;

                    // Try different methods to delete the file
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    } elseif (file_exists(public_path($imagePath))) {
                        unlink(public_path($imagePath));
                    } elseif (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    // Update database regardless of file deletion success
                    $post->thumb = null;
                    $post->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'Image deleted successfully'
                    ]);
                }
            } else {
                // Handle translatable image deletion
                $locale = request('locale');
                $translation = $post->translations()->where('locale', $locale)->first();

                if ($translation && $translation->image) {
                    $imagePath = config('config.image_path').'/'.$translation->image;

                    // Try different methods to delete the file
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    } elseif (file_exists(public_path($imagePath))) {
                        unlink(public_path($imagePath));
                    } elseif (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    // Update database regardless of file deletion success
                    $translation->image = null;
                    $translation->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'Image deleted successfully'
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'No image found to delete'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting image: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }
}
