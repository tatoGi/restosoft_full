@extends('website.master')
@section('main')
@if (isset($section->cover)   )
<div class="section-banner">
    <div class="section-cover">
        <img src="{{image($section->cover)}}" alt="">
    </div>
    <div class="breadcrumbs">
        <div class="container">
            <div class="crumbs font-18 line-54">
                @foreach ($breadcrumbs as $breadcrumb)
                @if ($loop->last)
                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                @else
                <a  href="@if($loop->first)/ @else{{ $breadcrumb['url'] }} @endif">{{ $breadcrumb['name'] }}</a>
                <span></span>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@else
<div class="section-banner">
    <div class="section-cover">
        <img src="/website/img/banner.png" alt="">
    </div>
    <div class="breadcrumbs">
        <div class="container">
            <div class="crumbs font-18 line-54">
                @foreach ($breadcrumbs as $breadcrumb)
                @if ($loop->last)
                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                @else
                <a  href="@if($loop->first)/ @else{{ $breadcrumb['url'] }} @endif">{{ $breadcrumb['name'] }}</a>
                <span></span>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@endif
@yield('content')
@endsection
