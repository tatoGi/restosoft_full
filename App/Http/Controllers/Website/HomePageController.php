<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Post;
use App\Models\Section;

class HomePageController extends Controller
{
    public static function homePage($model, $locales = null)
    {
        if ($model == null) {
            $locales = [];
            foreach (config('app.locales') as $value) {
                $locales[$value] = '/'.$value;
            }

            // Return homepage with default values when model is null
            return view('website.home', [
                'model' => null,
                'language_slugs' => [],
                'mainBanner' => Banner::whereHas('translation', function ($q) {
                    $q->where('active', 1)->whereLocale(app()->getLocale());
                })->where('type_id', 1)->orderBy('date', 'desc')->get(),
                'disinfo' => Section::where('type_id', 8)->with('translations')->first(),
                'disinfo_posts' => Post::whereHas('translation', function ($q) {
                    $q->where('active', 1);
                })->orderBy('date', 'desc')->limit(4)->get(),
                'sidebanners' => Banner::whereHas('translation', function ($q) {
                    $q->where('active', 1);
                })->where('type_id', 2)->orderBy('date', 'desc')->get(),
                'updates' => Section::where('type_id', 7)->with('translation')->first(),
                'updates_posts' => Post::whereHas('translation', function ($q) {
                    $q->where('active', 1);
                })->orderBy('date', 'desc')->limit(4)->get(),
                'about_section' => Section::where('type_id', 4)->with('translations')->first(),
                'about_posts' => Post::whereHas('parent', function ($q) {
                    $q->where('type_id', 4);
                })->with('translation', function ($q) {
                    $q->where('active', 1);
                })->where('active_on_home', 1)->orderBy('date', 'desc')->first(),
                'partners_banner' => Banner::whereHas('translations', function ($q) {
                    $q->where('active', 1)->whereLocale(app()->getLocale());
                })->where('type_id', 3)->orderBy('date', 'desc')->get()
            ]);
        }

        if ($locales == null) {
            $locales = [];
            foreach (config('app.locales') as $value) {
                $locales[$value] = '/'.$value;
            }
        }
        $section = $model;

        $language_slugs = $model->getTranslatedFullSlugs();

        $mainBanner = Banner::whereHas('translation', function ($q) {
            $q->where('active', 1)->whereLocale(app()->getLocale());
        })->where('type_id', 1)
        ->orderBy('date', 'desc')->get();

        $sidebanners = Banner::whereHas('translation', function ($q) {
            $q->where('active', 1);
        })->where('type_id', 2)
        ->orderBy('date', 'desc')->get();
        $updates = Section::where('type_id', 7)->with('translation')->first();
        $updates_posts = Post::where('section_id', $updates->id)->whereHas('translation', function ($q) {
            $q->where('active', 1);
        })->orderBy('date', 'desc')->limit(4)->get();

        $disinfo = Section::where('type_id', 8)->with('translations')->first();

        $disinfo_posts = Post::where('section_id', $disinfo->id)->whereHas('translation', function ($q) {
            $q->where('active', 1);
        })->orderBy('date', 'desc')->limit(4)->get();

        $about_section = Section::where('type_id', 4)->with('translations')->first();
        $about_posts = Post::whereHas('parent', function ($q) {
            $q->where('type_id', 4);
        })->with('translation', function ($q) {
            $q->where('active', 1);
        })->where('active_on_home', 1)->orderBy('date', 'desc')->first();

        $partners_banner = Banner::whereHas('translations', function ($q) {
            $q->where('active', 1)->whereLocale(app()->getLocale());
        })->where('type_id', 3)
            ->orderBy('date', 'desc')->get();
        // dd($about_posts[0]->coalition_banner);
        return view('website.home', compact('model',
        'language_slugs', 'mainBanner', 'disinfo', 'disinfo_posts',
        'sidebanners', 'updates', 'updates_posts', 'about_section', 'about_posts' , 'partners_banner'));
    }
}
