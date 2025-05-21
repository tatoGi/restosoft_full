<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public static function search(Request $request)
    {
        $model = [];
        $language_slugs['ka'] = 'ka/search?que='.$request->que;
        $language_slugs['en'] = 'en/search?que='.$request->que;
        $validatedData = $request->validate([
            'que' => 'required',
        ]);
        $searchText = $validatedData['que'];

        $postTranlations = PostTranslation::whereActive(true)->whereLocale(app()->getLocale())
            ->where('title', 'LIKE', "%{$searchText}%")
            ->orWhere('desc', 'LIKE', "%{$searchText}%")
            ->orWhere('text', 'LIKE', "%{$searchText}%")
            ->orWhere('keywords', 'LIKE', "%{$searchText}%")
            ->orWhere('locale_additional', 'LIKE', "%{$searchText}%")->pluck('post_id')->toArray();
        $posts = Post::whereIn('id', $postTranlations)->with('translations', 'parent', 'parent.translations')->paginate(settings('paginate'));
        $posts->appends(['que' => $searchText]);
        $data = [];
        foreach ($posts as $post) {
            $data[] = [
                'slug' => $post->getFullSlug() ?? '#',
                'title' => $post->translate(app()->getLocale())->title,
                'desc' => str_limit(strip_tags($post->translate(app()->getLocale())->desc)),
            ];
        }

        return view('website.pages.search.index', compact('posts', 'language_slugs', 'searchText'));
    }
}
