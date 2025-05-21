@extends('website.master')

@section('main')
@if (isset($model->parent->cover)) 
<section>
    <div class="about-banner">
        <img src="{{image($model->parent->cover)}}" alt="{{$post->translate(app()->getlocale())->title}}" title="{{$post->translate(app()->getlocale())->title}}">
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
    <div class="publication-cont">
        <div class="publications-detail">
            <div class="publication-div1">
                <div class="publication-info-title title-res">
                    {{$post->translate(app()->getlocale())->title}}
                 </div>
                 @if(isset($post->translate(app()->getlocale())->image))
                <div class="publication-detail-img">
                    <img src="{{image($post->translate(app()->getlocale())->image)}}" alt="{{$post->translate(app()->getlocale())->alt_text}}">
                </div>
                @endif
                <div class="publication-info">
                    <div class="publication-info-title">
                        {{$post->translate(app()->getlocale())->title}}
                    </div>
                    <div class="publication-info-date">
                        <span>{{ \Carbon\Carbon::parse($post->date)->translatedFormat('d') }}</span>
                        <span>{{ \Carbon\Carbon::parse($post->date)->translatedFormat('F') }}</span>
                        <span> {{ \Carbon\Carbon::parse($post->date)->translatedFormat('Y') }}</span>
                    </div>
                    <div class="publication-info-button">
                        <a href="{{ '/' . config('config.file_path'). $post->translate(app()->getlocale())->file }}" target="_blank" >
                            <span>
                                <img src="/assets/images/img/material-symbols_file-copy-outline-rounded.svg" alt="{{$post->translate(app()->getlocale())->alt_text}}">
                            </span>
                            {{ trans('website.preview') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="publication-div2">{!! $post->translate(app()->getlocale())->text !!}</div>
            <div class="share">
                <span class="share-share">{{ trans('website.share') }}:</span>
                <a href="">
                    <span class="icon-Path-171"></span>
                </a>
                <a href="">
                    <span class="icon-Path-172"></span>
                </a>
                <a href="">
                    <span class="icon-plus"></span>
                </a>
            </div>
        </div>

        <div class="publication-detail_latest-publications_main">
            <div class="latest-publications_main">
                <div class="updates-heandler">
                    <span class="icon-Vector-21"></span>
                </div>
                <div class="latest-publications_title-div"><span class="latest-publications_title">{{$updates->translate(app()->getlocale())->title}}</span></div>
                <div class="latest-updates">
                    @foreach ($updates_posts as $updates_post)
                    @if($updates_post->id != $post->id)
                    <div class="latest-updates_info">
                        <a href="/{{ $updates_post->getFullSlug() }}">
                            <div class="latest-updates_text">
                                {{ $updates_post->translate(app()->getlocale())->title }}
                            </div>
                            <div class="latest-updates_date">
                                <span>{{ \Carbon\Carbon::parse($updates_post->date)->format('d') }}</span>
                                <span>{{ \Carbon\Carbon::parse($updates_post->date)->translatedFormat('M') }}</span>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

