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
    <div class="update-tables">
        
        @if(isset($posts) && (count($posts) > 0))
        @foreach ($posts as $post)
        <div class="update-tables_table">
            <a href="/{{$post->getfullslug()}}">
                <div class="update-table_img">
                    <img src="{{ image($post->thumb) }}" alt="">
                </div>
                <div class="update-table_info">
                    <div class="update-table_info1"> {{ str_limit($post->translate(app()->getlocale())->desc, 75 , '...') }}</div>
                    <div class="latest-updates_date">
                        <span>{!! getDates($post->date) !!}</span>
                       
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</section>

{{ $posts->links('website.components.pagination') }}

@endsection