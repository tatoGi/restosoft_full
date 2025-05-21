@extends('website.master')
@section('main')

    <section class="container">
        <div class="update-detail">
            <div class="update-detail-info">

                @if (isset($model->parent->cover))
                    <div class="update-detail_banner">
                        <img src="{{ image($post->parent->cover) }}" alt="{{ $post->translate(app()->getlocale())->title }}"
                            title="{{ $post->translate(app()->getlocale())->title }}">
                    </div>
                @endif

                @if (isset($breadcrumbs))
                    <div class="pagepath">
                        <div class="pagepath-title">
                            <a href="/"><span
                                    class="icon-material-symbols_arrow-right-alt-rounded"></span>{{ trans('website.home') }}</a>
                        </div>
                        @foreach ($breadcrumbs as $breadcrumb)
                            <div class="pagepath-title">
                                <a href=""/{{ $breadcrumb['url'] }}"><span
                                        class="icon-material-symbols_arrow-right-alt-rounded"></span>
                                    {{ $breadcrumb['name'] }}</a>
                            </div>
                        @endforeach

                    </div>
                @endif
                <div class="update-detail_info">
                    <h2>{{ $post->translate(app()->getlocale())->title }}</h2>
                    <span>{{ \Carbon\Carbon::parse($post->date)->translatedFormat('d F, Y') }}</span>
                    <div class="update-detail_text">{!! $post->translate(app()->getlocale())->text !!}</div>


                    @if (isset($post->start_date) && isset($post->end_date))
                        @if (Carbon\Carbon::now()->gt($model->additional['start_date']) &&
                                Carbon\Carbon::now()->lt($model->additional['end_date']))
                            <div class="update-registration">
                                <div class="update-registration-img">
                                    <img src="/assets/images/img/Frame 9 (1).svg" alt="img">
                                    <span
                                        class="update-registration_date1">{{ trans('website.registration_period') }}:</span>
                                </div>
                                <div class="update-registration_date">
                                    <span
                                        class="update-registration_date1">{{ trans('website.registration_period') }}:</span>
                                    <div>
                                        <span>{{ \Carbon\Carbon::parse($post->start_date)->translatedFormat('d F, Y') }}</span>
                                        <span>{{ \Carbon\Carbon::parse($post->end_date)->translatedFormat('d F, Y') }}</span>
                                    </div>

                                </div>
                                <div class="update-registration_button">
                                    <button type="submit">{{ trans('website.apply') }}</button>
                                </div>
                            </div>
                        @endif
                    @elseif(isset($post->start_date) && !isset($post->end_date))
                        @if (Carbon\Carbon::now()->gt($model->additional['start_date']))
                            <div class="update-registration">
                                <div class="update-registration-img">
                                    <img src="/assets/images/img/Frame 9 (1).svg" alt="img">
                                    <span
                                        class="update-registration_date1">{{ trans('website.registration_period') }}:</span>
                                </div>
                                <div class="update-registration_date">
                                    <span
                                        class="update-registration_date1">{{ trans('website.registration_available') }}:</span>

                                </div>
                                <div class="update-registration_button">
                                    <button type="submit">{{ trans('website.apply') }}</button>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if (isset($post->files) && count($post->files) > 0)
                        <div class="update-detail_gallery">
                            @foreach ($post->files as $image)
                    @if(isset($image->title))
                <a href="{{ $image->title }}" data-fancybox="gallery">
                   <img class="gallery-img" src="{{ image($image->file) }}" alt="{{$image['file_additional'][app()->getlocale()]}}">
                   
                    <span class="video-button"><img src="/assets/images/img/Polygon_2.png" alt="{{$image['file_additional'][app()->getlocale()]}}"></span>
                </a>
                @else
                <a href="{{ image($image->file) }}" data-fancybox="gallery">
                    <img src="{{ image($image->file) }}" alt="{{$image['file_additional'][app()->getlocale()]}}">
                </a>
                @endif
                @endforeach
                        </div>
                    @endif
                </div>

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
            @if(isset($updates_posts))
            <div class="update-latest-updates">
                
                <div class="latest-updates_titel-div eudisinfo-posts"><span class="latest-updates_titel">{{$updates->translate(app()->getlocale())->title}}</span></div>
                <div class="latest-updates_main">
                    <div class="updates-heandler">
                        <span class="icon-Vector-21"></span>
                    </div>
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
            @endif
        </div>
    </section>
    <section class="registration">
        
        <div class="registration-form_background"></div>
        <form action="/{{$post->getFullSlug()}}" method="POST">
        <div class="registration-form">
            <div class="reg-row1">
                <h3>{{ trans('website.registration_form') }}</h3>
                <div class="reg-x">
                    <span class="icon-Vector-6"></span>
                </div>
            </div>
            <div class="registration-grid">
                
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="mandatory-input">
                    <label class="star" for="registration-name">{{ trans('website.full_name') }}</label>
                    <input id="registration-name" type="text" name="full_name" required>
                    <span class="man-span">It should contain at least one upper-case letter and number.</span>
                </div>
                <div class="mandatory-input">
                    <label class="star" for="registration-email">{{ trans('website.email') }}</label>
                    <input id="registration-email" type="email" name="email" required>
                    <span class="man-span">It should contain at least one upper-case letter and number.</span>
                </div>
                <div class="mandatory-input">
                    <label class="star" for="registration-title">{{ trans('website.title') }}</label>
                    <input id="registration-title" type="text" name="title">
                    <span class="man-span">It should contain at least one upper-case letter and number.</span>
                </div>
                <div class="mandatory-input">
                    <label class="star" for="registration-work">{{ trans('website.work_place') }}</label>
                    <input id="registration-work" type="text" name="work_place">
                    <span class="man-span">It should contain at least one upper-case letter and number.</span>
                </div>
                <div class="grid-100">
                    <label for="">{{ trans('website.social_media_link') }}</label>
                    <input type="text" name="social_media_link">
                </div>
                <div class="grid-100">
                    <label for="">{{ trans('website.comment') }}</label>
                    <textarea name="comment" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="registration-button">
                    <button type="submit">{{ trans('website.sent') }}</button>
                </div>
            </div>
        </div>
        <form>
    </section>
@endsection
