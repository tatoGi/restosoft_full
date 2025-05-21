<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Post;
use App\Models\Section;
use App\Models\Submission;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public static function index($model, Request $request)
    {
        // dd($request, 'section');
        if (request()->method() == 'POST') {

            $values = request()->all();

            $values['additional'] = getAdditional($values, config('submissionAttr.additional'));

            $submission = Submission::create($values);

            return redirect()->back()->with([

                'message' => trans('website.submission_sent'),

            ]);

        }
        $section = $model;

        $language_slugs = $section->getTranslatedFullSlugs();

        // BreadCrumb ----------------------------

        $breadcrumbs = [];

        $breadcrumbs[] = [

            'name' => $model[app()->getlocale()]->title,

            'url' => $model->getFullSlug(),

        ];

        while ($section->parent_id !== null) {

            $section = Section::where('id', $model->parent_id)->with('translations')->first();

            $breadcrumbs[] = [

                'name' => $section->title,

                'url' => $section->getFullSlug(),

            ];

        }

        $breadcrumbs = array_reverse($breadcrumbs);

           switch ($model->type_id) {

            case 1:

            return HomePageController::homePage($model, $locales = null);

            case 2:

                 $post = Post::where('section_id', $model->id)->whereHas('translations', function ($q) {

                    $q->where('active', 1);

                })->first();

            return view('website.pages.contact.show', compact('model', 'language_slugs', 'breadcrumbs', 'post'), ['successMsg' => 'Contact form successfully send']);

            case 3:
                $posts = Post::where('section_id', $model->id)->whereHas('translation', function ($q) {
                    $q->whereActive(true);
                })->orderBy('date', 'desc')->paginate(settings('campaigns_pagination'));

                // Get the first active post for services
                $servicePost = Post::where('section_id', $model->id)
                    ->whereHas('translation', function ($q) {
                        $q->whereActive(true);
                    })
                    ->with(['translation' => function($q) {
                        $q->where('locale', app()->getLocale());
                    }])
                    ->first();

            return view('website.pages.services.index', compact('model', 'breadcrumbs', 'language_slugs', 'posts', 'servicePost'));

            case 4:

            $post = Post::where('section_id', $model->id)->with('translations', 'files')->first();

            $partners_banner = Banner::whereHas('translations', function ($q) {
                $q->where('active', 1)->whereLocale(app()->getLocale());
            })->where('type_id', 3)
            ->orderBy('date', 'desc')->get();

            $updates = Section::where('type_id', 7)->with('translation')->first();
            $updates_posts = Post::where('section_id', $updates->id)->whereHas('translation', function ($q) {
                $q->where('active', 1);
            })->orderBy('date', 'desc')->limit(4)->get();

            $publications = Section::where('type_id', 6)->with('translation')->first();
            $latest_publications = Post::where('section_id', $publications->id)->whereHas('translation', function ($q) {
                $q->where('active', 1);
            })->orderBy('date', 'desc')->limit(4)->get();

            return view('website.pages.text_page.show', compact('model', 'breadcrumbs', 'language_slugs', 'post', 'partners_banner', 'updates_posts', 'latest_publications', 'updates', 'publications'));

            case 6:

                $posts = Post::where('section_id', $model->id)->whereHas('translation', function ($q) {
                    $q->whereActive(true);
                })->orderBy('date', 'desc')->paginate(settings('publication_pagination'));

            return view('website.pages.publications.index', compact('model', 'breadcrumbs', 'language_slugs', 'posts'));

            case 7:

                $post = Post::where('section_id', $model->id)->whereHas('translation', function ($q) {
                    $q->whereActive(true);
                })->with('translations')->orderBy('date', 'desc')->first();

            return view('website.pages.about.index', compact('model', 'breadcrumbs', 'language_slugs', 'post'));

            case 8:

                $posts = Post::where('section_id', $model->id)->whereHas('translation', function ($q) {
                    $q->whereActive(true);
                })->orderBy('date', 'desc')->paginate(settings('eu_vs_disinfo_pagination'));

            return view('website.pages.eu_vs_disinfo.index', compact('model', 'breadcrumbs', 'language_slugs', 'posts'));

        default:

            $posts = Post::where('section_id', $model->id)

                ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')

                ->where('post_translations.locale', '=', app()->getLocale())

                ->select('posts.*', 'post_translations.text', 'post_translations.desc', 'post_translations.title', 'post_translations.locale_additional', 'post_translations.slug')
                ->where('active', 1)->whereLocale(app()->getLocale())
                ->with('files')
                ->orderBy('date', 'desc')

                ->paginate(settings('paginate'));

            $vacancy = Section::where('type_id', 6)->with('translations')->with('posts')->first();

            $popular_vacancy = Post::where('section_id', $vacancy->id)->whereHas('translations', function ($q) {

            $q->where('active', 1);

            })->where('populars', 1)->first();

            $programs = Section::where('type_id', 3)->with('translations')->with('posts')->first();

            return view("website.pages.{$model->type['folder']}.index", compact('model', 'breadcrumbs', 'language_slugs',

                'posts', 'vacancy', 'popular_vacancy', 'programs'

            ));

    }

        return view("website.pages.{$model->type['folder']}.index", compact(['model', 'breadcrumbs',

            'language_slugs', 'posts', 'vacancy', 'popular_vacancy', 'programs']));

    }

    public static function submenu($model)
    {

        $breadcrumbs = [];

        $sec = $model;

        $breadcrumbs[] = [

            'name' => $model->title,

            'url' => $model->getFullSlug(),

        ];

        while ($sec->parent_id !== null) {

            $sec = Section::where('id', $model->parent_id)->with('translations')->first();

            $breadcrumbs[] = [

                'name' => $sec->title,

                'url' => $sec->getFullSlug(),

            ];

        }

        $sec = Section::where('type_id', sectionTypes()['home']['id'])->with('translations')->first();

        $breadcrumbs[] = [

            'name' => $sec->title,

            'url' => $sec->getFullSlug(),

        ];

        $breadcrumbs = array_reverse($breadcrumbs);

        $submenu_sections = Section::where('parent_id', $model->id)->orderBy('order', 'asc')->get();

        return view('website.pages.submenu.index', compact('model', 'submenu_sections', 'breadcrumbs'));

    }

    public static function show($model)
    {
        $post = $model;

        if (request()->method() == 'POST') {

            $values = request()->all();

            $values['additional'] = getAdditional($values, config('submissionAttr.additional'));

            $submission = Submission::create($values);

            return redirect()->back()->with([

                'message' => trans('website.submission_sent'),

            ]);

        }
        $language_slugs = $post->getTranslatedFullSlugs();

            // BreadCrumb ----------------------------

        $breadcrumbs = [];

        $breadcrumbs[] = [

            'name' => $model[app()->getLocale()]->title,

            'url' => $model->getFullSlug(),

        ];

        if ($model->section_id !== null) {

            $section = Section::where('id', $model->section_id)->with('translation')->first();

            $breadcrumbs[] = [

                'name' => $section[app()->getLocale()]->title,

                'url' => $section->getFullSlug(),

            ];

            while ($section->parent_id !== null) {

                $sec = Section::where('id', $section->section_id)->with('translation')->first();

                $breadcrumbs[] = [

                    'name' => $sec[app()->getLocale()]->title,

                    'url' => $sec->getFullSlug(),

                ];

            }

        }

        $breadcrumbs = array_reverse($breadcrumbs);

        $updates = Section::where('type_id', $model->parent->type_id)->with('translation')->first();
        $updates_posts = Post::where('section_id', $updates->id)->whereHas('translation', function ($q) {
            $q->where('active', 1);
        })->orderBy('date', 'desc')->limit(4)->get();

        $model->views = $model->views + 1;

        $model->save();

        $model->type_id = $model->parent->type_id;

        return view("website.pages.{$section->type['folder']}.show", [

            'model' => $model,

            'section' => $section, 'post' => $post,

            'post' => $model,

            'breadcrumbs' => $breadcrumbs, 'language_slugs' => $language_slugs,

            'updates' => $updates,

            'updates_posts' => $updates_posts,

        ])->render();

    }
}
