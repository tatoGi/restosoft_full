<?php

namespace App\Http\View\Composers;

use App\Models\Banner;
use App\Models\Section;
use Illuminate\View\View;

class WebsiteComposer
{
    private $sections;

    private $footerSections;

    private $underfootermenu;

    private $contact;

    private $disclaimer_banner;

    public function __construct()
    {

        $this->sections = Section::whereHas('translation', function ($q) {
            $q->whereActive(true);
        })
        ->whereHas('menuTypes', function ($q) {
            $q->where('menu_type_id', 1);
        })->where('parent_id', null)
        ->orderBy('order', 'asc')
        ->get();

         $this->footerSections = Section::whereHas('translations', function ($q) {
            $q->whereActive(true)->whereLocale(app()->getLocale());
        })
        ->whereHas('menuTypes', function ($q) {
            $q->where('menu_type_id', 2);
        })->where('parent_id', null)
        ->orderBy('order', 'asc')
        ->get();

        $this->underfootermenu = Section::whereHas('translation', function ($q) {
            $q->whereActive(true);
        })
        ->whereHas('menuTypes', function ($q) {
            $q->where('menu_type_id', 3);
        })->where('parent_id', null)
        ->orderBy('order', 'asc')
        ->get();

        // $this->footerSections = Section::whereHas('translations', function($q) {
        //     $q->where('active' , 1)->whereLocale(app()->getLocale());
        // })->orderBy('order', 'asc')->limit(6)->get();

            $this->contact = Section::where('type_id', sectionTypes()['contact']['id'])->with('translations')->first();

            $this->disclaimer_banner = Banner::whereHas('translation', function ($q) {
                $q->where('active', 1)->whereLocale(app()->getLocale());
            })->where('type_id', 4)
            ->orderBy('date', 'desc')->first();

    }

    public function compose(View $view)
    {
        $view->with([
            'sections' => $this->sections,
            'footerSections' => $this->footerSections,
            'underfootermenu' => $this->underfootermenu,
            'sidebar_menu' => $this->footerSections,
            'contact' => $this->contact,
            'disclaimer_banner' => $this->disclaimer_banner,

        ]);
    }
}
