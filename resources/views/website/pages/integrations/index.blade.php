@extends('website.master')
@section('main')
@if(isset($model->cover))
<section>
    <div class="about-banner">
        <img src="{{image($model->cover)}}" alt="{{$model->translate(app()->getlocale())->title}}" title="{{$model->translate(app()->getlocale())->title}}">
    </div>
</section>
@else
<div class="banner-margin"></div>
@endif
@if(isset($breadcrumbs))
<section class="container">
    <div class="pagepath">
        <div class="pagepath-title">
            <a href="/"><span class="icon-material-symbols_arrow-right-alt-rounded"></span>{{ trans('website.home') }}</a>
        </div>
        @foreach ($breadcrumbs as $breadcrumb)
        <div class="pagepath-title">
            <a href=""/{{ $breadcrumb['url'] }}"><span class="icon-material-symbols_arrow-right-alt-rounded"></span>
                {{ $breadcrumb['name'] }}</a>
        </div>
        @endforeach
    </div>
</section>
@endif
<section class="container">
    <div class="update-table_title">
        <span class="update-tables_title">{{$model->translate(app()->getlocale())->title}}</span>
    </div>

    <div class="publication-table">
        
        @if(isset($posts) && (count($posts) > 0))
        @foreach ($posts as $post)
        <div class="publication-border">
            <div class="publication-main">
                <a href="/{{$post->getfullslug()}}">
                    <div class="publication-title">{{ $post->translate(app()->getlocale())->title }}</div>
                    <div class="publication-img">
                        <img src="{{ image($post->translate(app()->getlocale())->image) }}" alt="{{ $post->translate(app()->getlocale())->alt_text}}">
                    </div>
                    <div class="publication-date">
                        <span>{{ \Carbon\Carbon::parse($post->date)->format('d') }}</span>
                        <span>{{ \Carbon\Carbon::parse($post->date)->translatedFormat('M') }}</span>
                        <span>{{ \Carbon\Carbon::parse($post->date)->translatedFormat('Y') }}</span>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
        @endif
    </div>

</section>

{{ $posts->links('website.components.pagination') }}
@endsection
