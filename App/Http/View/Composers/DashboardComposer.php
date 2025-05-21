<?php

namespace App\Http\View\Composers;

use App\Models\Submission;
use App\Models\Subscription;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class DashboardComposer
{
    private $notifications;

    private $subscribe;

    public $locales = [];

    public function __construct()
    {
        $this->notifications = Submission::where('seen', 0)->with('post.parent')->orderBy('created_at', 'desc')->get();
        $this->subscribe = Subscription::where('locale', '=', app()->getlocale())->orderBy('created_at', 'desc')->get();

        foreach (Config::get('app.locales') as $locale) {
            $currentLocale = '/'.app()->getLocale().'/';
            $thisLocale = '/'.$locale.'/';
            $this->locales[$locale] = str_replace($currentLocale, $thisLocale, url()->full());
        }
    }

    public function compose(View $view)
    {

        $view->with([
            'subscribes' => $this->subscribe,
            'notifications' => $this->notifications,
            'locales' => $this->locales,
        ]);
    }
}
