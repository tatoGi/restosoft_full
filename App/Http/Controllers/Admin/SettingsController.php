<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\SettingsFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
  public function edit()
  {
    $settings = config('settings.settings');
    // dd($settings);
    $sections = Section::with('translations')->get();

    //  dd($settings);

    return view('admin.settings.edit', compact(['settings', 'sections']));
  }

  public function update(Request $request)
  {
    // Load the existing settings configuration
    $settings = config('settings.settings');
    if ($request->has('translatables')) {
      foreach ($request->translatables as $key => $value) {
        if (is_array($value)) {

          $settings[$key] = config('settings.settings.'.$key);
          $filename = base_path('config/settings/settings.php');
          $settings[$key]['value'] = $value;
          if (is_file($filename)) {
            file_put_contents($filename, arrayToPhpArray($settings));
          }
        }
      }
    }
    if ($request->has('nonTranslatables')) {
      foreach ($request->nonTranslatables as $key1 => $value1) {
        if (! is_array($value1)) {
          $settings[$key1] = config('settings.settings.'.$key1);
          $filename = base_path('config/settings/settings.php');
          $settings[$key1]['value'] = $value1;
          if (is_file($filename)) {
            file_put_contents($filename, arrayToPhpArray($settings));
          }
        }
      }
    }

    // Update the settings configuration file
    $filename = base_path('config/settings/settings.php');
    if (is_file($filename)) {
      file_put_contents($filename, arrayToPhpArray($settings));
    }

    // Redirect with a success message
    return redirect('/'.app()->getLocale().'/admin/settings/edit')->with('message', trans('admin.successfully_saved'));
  }

  public function uploadFile(Request $request)
  {
    $locale = $request->input('locale');
    $file = $request->file('file');
    $inputName = $request->input('inputName');

    if ($file->getSize() > 2097152) {
      return response()->json(['error' => 'File size is greater than 2MB.']);
    }

    $fileName = time().'.'.$file->extension();
    $logoPath = config('config.icon_path');

    $logoUrl = asset($logoPath.$fileName);

    $file->move($logoPath, $fileName);

    $settingsFile = new SettingsFile();
    $settingsFile->locale = $locale;
    $settingsFile->name = $fileName;
    $settingsFile->path = $logoPath;
    $settingsFile->url = $logoUrl;
    $settingsFile->save();
    $settings = config('settings.settings');
    if ($inputName == 'eu_vs_disinfo_logo') {
      $settings['eu_vs_disinfo_logo']['value'] = $fileName;
    } else {
      $settings['coalition_logo']['value'][$locale]['url'] = $logoUrl;
      $settings['coalition_logo']['value'][$locale]['name'] = $fileName;
    }

    $filename = base_path('config/settings/settings.php');
    $contents = arrayToPhpArray($settings);
    if (is_file($filename)) {
      file_put_contents($filename, $contents);
    }

    return response()->json(['filename' => $fileName]);
  }

  public function deleteFile(Request $request)
  {
    $locale = $request->input('locale');
    $file = $request->input('file');

    $settingsFile = SettingsFile::where('name', $file)->first();

    if (! $settingsFile) {
      return response()->json(['error' => 'File not found']);
    }

    $path = public_path($settingsFile->path.$settingsFile->name);
    if (file_exists($path)) {
      unlink($path);
    }
    $settings = config('settings.settings');
    if ($locale != '') {
      $settings['coalition_logo']['value'][$locale]['url'] = '';
      $settings['coalition_logo']['value'][$locale]['name'] = '';
    } else {
      $settings['eu_vs_disinfo_logo']['value'] = '';
    }
    $filename = base_path('config/settings/settings.php');
    $contents = arrayToPhpArray($settings);
    if (is_file($filename)) {
      file_put_contents($filename, $contents);
    }
    $settingsFile->delete();

    return response()->json(['success' => true]);
  }
}
