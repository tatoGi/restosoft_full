@extends('website.master')
@section('main')
<section>
    <div class="about-banner">
        <img src="/assets/images/img/Mask group About banner.png" alt="banner-img">
    </div>
</section>
<section class="container">
    <div class="pagepath">
        <div class="pagepath-title">
            <a href="/"><span class="icon-material-symbols_arrow-right-alt-rounded"></span>{{ trans('website.home') }}</a>
        </div>
        <div class="pagepath-title">
            <a href="/{{app()->getlocale()}}/search"><span class="icon-material-symbols_arrow-right-alt-rounded"></span>{{ trans('website.search') }}</a>
        </div>
    </div>
</section>
<section class="container">
    <div class="search-cont">
        
        <form action="/{{app()->getlocale()}}/search" method="get">
            @if(!isset($searchText))<label for="search">Search</label> @endif
            
            <input  placeholder="{{ trans('website.search') }}" type="text" id="search" value="@if(isset($searchText)){{$searchText}}@endif" required name="que">
            <button>
                <span class="icon-Group-9991"></span>
            </button>
        </form>
        <div class="search-cont_result">{{ trans('website.result') }}: <span>@if(isset($posts)) {{count($posts)}} @endif</span></div>
    </div>
</section>

<section class="container">
    @if(isset($posts) && count($posts) > 0)
    @foreach ($posts as $item)
    <div class="search-result">
        <a href="/{{ $item->getfullslug() }}">
            <h3>{!! strip_tags($item->translate(app()->getlocale())->title) !!}</h3>
            <div>{!! strip_tags($item->translate(app()->getlocale())->text) !!}</div>
            <div class="search-section-name">
                <span>{!! strip_tags($item->parent->translate(app()->getlocale())->title) !!}</span>
                <span class="icon-Vector-5"></span>
            </div>
        </a>
    </div>
    @endforeach
    @endif
</section>
@endsection
