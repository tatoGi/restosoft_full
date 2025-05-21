<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class UploadFilesController extends Controller
{
  public function uploadImage(Request $request)
  {

    $file_name = uniqid().'.'.$request->file('file')->getClientOriginalExtension();

    // Generate Thumbnail
    Image::make($request->file('file'))->fit(config('config.thumbnail.width'), config('config.thumbnail.height'))
    ->save(config('config.image_path').config('config.thumb_path').$file_name, 70);

    // Save original image
    Image::make($request->file('file'))->save(config('config.image_path').$file_name, 70);

    DB::table('temp_files_table')->insert([
        'file_name' => $file_name,
        'path' => config('config.image_path'),
        'user_id' => auth()->user()->id,
        'additional_paths' => json_encode(['path' => config('config.image_path').config('config.thumb_path')]),
    ]);

    return [
        'error' => false,
        'image' => $file_name,
        'thumb' => config('config.image_path').config('config.thumb_path').$file_name,
    ];
  }

  public function deleteImage(Request $request)
  {
    $files = $request->input('files');

    if (! is_array($files)) {
      $files = [0 => $files];
    }

    foreach ($files as $file) {
      if (File::exists(config('config.image_path').$file)) {
        File::delete(config('config.image_path').$file);

    }
    if (File::exists(config('config.image_path').'thumb/'.$file)) {
      File::delete(config('config.image_path').'thumb/'.$file);

    }

    }

    DB::table('temp_files_table')->whereIn('file_name', $files)->delete();
    DB::table('post_files')->whereIn('file', $files)->delete();

    DB::table('posts')->whereIn('thumb', $files)->update(['thumb' => null]);

    return ['error' => false];
  }

  public function clearChache()
  {
    $temp_files = DB::table('temp_files_table')->where('user_id', auth()->user()->id)->get();

    foreach ($temp_files as $temp_file) {
      File::unlink($temp_file->path.$temp_file->file_name);
      $arr = json_decode($temp_file->additional_paths);

      foreach ($arr as $value) {
        File::unlink($arr->path.$temp_file->file_name);
      }
    }

    DB::table('temp_files_table')->where('user_id', auth()->user()->id)->delete();
  }

  public function getImage($d, $i, $original = null, $type = null)
  {

    $dimentions = explode('x', $d);
    // dd($dimentions);
    $dimentions = array_map('intval', $dimentions);

    $file_path = config('config.image_path').$i.'.'.$original;

    if (! file_exists($file_path) || count($dimentions) != 2) {
        $file_path = public_path("uploads/banners/{$i}.{$original}");
        if (! file_exists($file_path) || count($dimentions) != 2) {

            $i = 'no-image';
            $original = 'jpg';
            $file_path = config('config.image_path').$i.'.'.$original;
        }
    //   return "error";
    }
    $ext = $type ? $type : $original;

    $modified = 0;

    $img = Image::cache(function ($image) use ($dimentions, &$modified, $file_path) {
      // return $image->make('public/foo.jpg')->resize(300, 200)->greyscale();
      $image->make($file_path)->fit($dimentions[0], $dimentions[1]);
      $modified = array_key_exists('modified', $image->properties) ? $image->properties['modified'] : time();
   }, 604800, true);

   if ($ext != $original) {
    $img = Image::canvas($dimentions[0], $dimentions[1], '#ffffff')->insert($img);
   }

   $response = $img->response($ext, 100);

   $folder_path = public_path("/image/{$d}");

   if (! File::exists($folder_path)) {
        mkdir($folder_path);
   }

   $fn = urldecode(basename(request()->url()));
   $img->save("{$folder_path}/{$fn}", 100);

   $browserCache = 60 * 60 * 24 * 7;

   $lastModified = gmdate('D, d M Y H:i:s', $modified).' GMT';
        $eTag = '"'.md5($response->getContent()).'"';
        $isModified = false;

        $ifModifiedSince = isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])
            ? stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE'])
            : false;
        $ifNoneMatch = isset($_SERVER['HTTP_IF_NONE_MATCH'])
            ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])
            : false;

        if (! $ifModifiedSince && ! $ifNoneMatch) {
            $isModified = true;
        } elseif ($ifNoneMatch && $ifNoneMatch !== $eTag) {
            $isModified = true;
        } elseif ($ifModifiedSince && $ifModifiedSince != $lastModified) {
            $isModified = true;
        }

        if ($isModified) {
            return $response->withHeaders([
                'Cache-Control' => 'private, max-age='.$browserCache,
                'Expires' => gmdate('D, d M Y H:i:s', time() + $browserCache).' GMT',
                'Content-Length' => strlen($response->getContent()),
                'Last-Modified' => $lastModified,
                'ETag' => $eTag,
            ]);
        } else {
            return $response->setNotModified();
    }

    return $response;
  }
}
