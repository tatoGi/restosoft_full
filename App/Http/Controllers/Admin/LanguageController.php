<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LanguageController extends Controller
{
    public function edit()
    {
        $realLocale = app()->getLocale();
        $languages = [];
        foreach (config('app.locales') as $locale => $language) {
            app()->setLocale($language);

            $languages[$language] = Lang::get('website');
        }
        app()->setLocale($realLocale);

        return view('admin.languages.edit', compact(['languages']));
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $key => $values) {
            if ($key !== '_token') {

                $filename = base_path('resources/lang/'.$key.'/website.php');
                $contents = arrayToPhpArray($values);
                if (is_file($filename)) {
                    file_put_contents($filename, $contents);
                }
            }
        }

        return redirect('/'.app()->getLocale().'/admin/languages/edit')->with('message', trans('admin.successfully_saved'));
    }
}
