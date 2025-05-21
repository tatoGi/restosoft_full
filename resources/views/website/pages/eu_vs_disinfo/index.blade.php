@extends('website.master')
@section('main')

<div class="container">
    <div class="disinfo-table-title">
        <div class="disinfo-table_img">
            <a href="{{ settings('eu_vs_disinfo_logo_link') }}"> <img src="{{ asset(config('config.icon_path') . settings('eu_vs_disinfo_logo')) }}" alt="img"></a>
        </div>
    </div>
</div>
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
    <div class="disinfo-table">

        <div class="disinfo-table_description">
            {!! $model->translate()->desc !!}
        </div>
        <div class="disinfo-table_div">
            
        @if(isset($posts) && (count($posts) > 0))
        @foreach ($posts as $post)
            <div class="disinfo-table_table">
                <a href="/{{$post->getfullslug()}}">
                    <span>
                        {!! getDates($post->date) !!}
                    </span>
                    <div class="disinfo-table_table-title"> {{ str_limit($post->translate(app()->getlocale())->desc, 75 , '...') }}</div>
                    <div class="disinfo-table_table-img">
                        <img src="{{ image($post->thumb) }}" alt="img">
                    </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
{{ $posts->links('website.components.pagination') }}

@endsection