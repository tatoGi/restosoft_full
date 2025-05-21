@extends('website.master')
@section('main')
<main>

    <div class="scroll-top-button">
        
    </div>
    <section>
        <div class="_banner">
            <div class="_banner-img">
                <img src="{{ image($model->parent->cover) }}" alt="banner">
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="brc-cont">
                <a href="/{{app()->getlocale()}}">{{ trans('website.home') }}</a>
                <span> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="10.07" height="17.14" viewBox="0 0 10.07 17.14">
                        <g id="right-arrow_1_" data-name="right-arrow (1)" transform="translate(-101.478)">
                        <g id="Group_213" data-name="Group 213" transform="translate(101.478)">
                            <path id="Path_140" data-name="Path 140" d="M111.274,7.9,103.647.274a.94.94,0,0,0-1.326,0l-.562.562a.939.939,0,0,0,0,1.326l6.405,6.405-6.412,6.412a.94.94,0,0,0,0,1.326l.562.561a.94.94,0,0,0,1.326,0l7.635-7.635a.946.946,0,0,0,0-1.331Z" transform="translate(-101.478 0)" fill="#29607e"/>
                        </g>
                        </g>
                    </svg> 
                </span>
                <a href="/{{$section->getfullslug()}}" >{{ $section[app()->getlocale()]->title }}</a>
                <span> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="10.07" height="17.14" viewBox="0 0 10.07 17.14">
                        <g id="right-arrow_1_" data-name="right-arrow (1)" transform="translate(-101.478)">
                        <g id="Group_213" data-name="Group 213" transform="translate(101.478)">
                            <path id="Path_140" data-name="Path 140" d="M111.274,7.9,103.647.274a.94.94,0,0,0-1.326,0l-.562.562a.939.939,0,0,0,0,1.326l6.405,6.405-6.412,6.412a.94.94,0,0,0,0,1.326l.562.561a.94.94,0,0,0,1.326,0l7.635-7.635a.946.946,0,0,0,0-1.331Z" transform="translate(-101.478 0)" fill="#29607e"/>
                        </g>
                        </g>
                    </svg> 
                </span>
                @foreach ($breadcrumbs as $breadcrumb)
                <a href="/{{ $breadcrumb['url'] }}" class="active-brc">{{ $breadcrumb['name'] }}</a>
                @endforeach
            </div>
            
        </div> 
    </section>
                        @if(Session::has('message'))
                          <p class="alert alert-info">{{ Session::get('message') }}</p>
                                    @endif
    <section>
        <div class="vacancy-det-section programs-det-padd"> 
            <div class="container">
                <div class="vacancy-det-box">
                    <h1>{{ $model->translate(app()->getlocale())->title }}</h1>
                    <div class="row row-resp-vacancy-det_01">
                        <div class="col-lg-6 col-12">
                            <div class="buttons-box">
                                <span class="box-00">
                                    <img src="/website/assets/img/students-cap.svg" alt="st">
                                    {{ $model->translate(app()->getlocale())->field_of_employment }}
                                </span>
                                <span class="box-00">
                                    <img src="/website/assets/img/calendar.png" alt="calendar">
                                    {{  $model->translate(app()->getlocale())->Duration  }}
                                </span>
                            </div>
                            <div class="requests-box">
                                <h2>{{__('website.Requirements') }}</h2>
                                <ul class="request-ul">
                                    @if(($model->translate()->Requirements != '') &&
                                    is_array(explode(",",$model->translate()->Requirements)))
                                    @foreach(explode(",",$model->translate()->Requirements) as $Requirements)
                                    <li>
                                        <a href="#">{{$Requirements}}</a>
                                    </li>
                                    @endforeach
                                    @endif
                                   
                                </ul>
                            </div>
                            <div class="text-det-vac">
                              {!!  $model->translate(app()->getlocale())->desc  !!}
                            </div> 
                            @if(isset( $model->translate(app()->getlocale())->locale_additional['file'] ))
                            <a href="/{{config('config.file_path').json_decode($post->translate(app()->getLocale())->locale_additional)->file}}" class="file-download" download>
                                <span> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="39.274" height="43.43" viewBox="0 0 39.274 43.43">
                                        <g id="attach" transform="translate(-64.084 -5.475)">
                                        <path id="Path_224" data-name="Path 224" d="M100.67,98H77.153a3.07,3.07,0,0,0-3.07,3.07v35.2a3.07,3.07,0,0,0,3.07,3.07h31.089a3.07,3.07,0,0,0,3.07-3.07V108.641Z" transform="translate(-8.976 -91.456)" fill="#fff"/>
                                        <path id="Path_225" data-name="Path 225" d="M344.558,108.641h-7.316a3.325,3.325,0,0,1-3.325-3.325V98Z" transform="translate(-242.223 -91.456)" fill="#e5bc62"/>
                                        <path id="Path_229" data-name="Path 229" d="M213.828,244H196.217a1.029,1.029,0,1,0,0,2.046h17.611a1.029,1.029,0,1,0,0-2.046Z" transform="translate(-123.268 -220.882)" fill="#4c8a9d"/>
                                        <path id="Path_230" data-name="Path 230" d="M213.828,316H196.217a1.029,1.029,0,1,0,0,2.047h17.611a1.029,1.029,0,1,0,0-2.047Z" transform="translate(-123.268 -285.515)" fill="#4c8a9d"/>
                                        <path id="Path_231" data-name="Path 231" d="M213.828,388H196.217a1.029,1.029,0,1,0,0,2.046h17.611a1.029,1.029,0,1,0,0-2.046Z" transform="translate(-123.268 -350.148)" fill="#4c8a9d"/>
                                        <path id="Path_232" data-name="Path 232" d="M103.357,17.135s0-.008,0-.012a.439.439,0,0,0-.005-.044,1.02,1.02,0,0,0-.292-.618L92.417,5.82a1.022,1.022,0,0,0-.681-.3l-.042,0H84.753c-9.381-.1-3.487.005-14.325,0H68.177a4.1,4.1,0,0,0-4.093,4.093v35.2A4.1,4.1,0,0,0,68.177,48.9H99.266a4.1,4.1,0,0,0,4.093-4.093V17.185C103.358,17.167,103.358,17.151,103.357,17.135ZM92.717,9.014l7.148,7.148H95.019a2.3,2.3,0,0,1-2.3-2.3V9.014Zm6.549,37.844H68.177a2.049,2.049,0,0,1-2.046-2.046V9.613a2.049,2.049,0,0,1,2.046-2.046H74.43c10.4.065,6.021.065,10.323,0H90.67V13.86a4.354,4.354,0,0,0,4.349,4.349h6.293v26.6A2.048,2.048,0,0,1,99.266,46.858Z" fill="#4c8a9d"/>
                                        </g>
                                    </svg> 
                                </span>
                                {{ __('webste.save_file') }}
                            </a>
                            @endif
                            <div class="socials">
                            <div class="addthis_inline_share_toolbox"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="v-det-right">
                                <div class="v-det-image">
                                    <img src="/website/assets/img/v-det.png" alt="v-det">
                                </div>
                                <div class="send-btn-active send-btn-active_2">
                                  {{ __("website.Send_an_application") }}
                                </div>
                                <div class="sent-form-det sent-form-det-2">
                                    <form action="/{{app()->getlocale()}}/submission" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <span class="close-btn close-btn-2">  
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24.116" height="25.068" viewBox="0 0 24.116 25.068">
                                                <g id="Group_909" data-name="Group 909" transform="translate(3.534 3.534)">
                                                <path id="Path_184" data-name="Path 184" d="M11634.921,4602.147l17.048,18" transform="translate(-11634.921 -4602.147)" fill="none" stroke="#fefcf7" stroke-linecap="round" stroke-width="5"/>
                                                <path id="Path_185" data-name="Path 185" d="M0,0,18,17.047" transform="translate(0.001 18) rotate(-90)" fill="none" stroke="#fefcf7" stroke-linecap="round" stroke-width="5"/>
                                                </g>
                                            </svg> 
                                        </span>
                                         <h1>{{trans('website.Send')}}</h1>

                                        <input type="hidden" name="post_id" value="{{ $model->id }}">
 
                                        <div class="sent-valid-input-box">
                                            <label for="">{{ __('admin.name') }}</label>
                                            <input type="text" name="name" placeholder="{{ __('admin.name') }}" autocomplete="off" required>
                                        </div>
                                        <div class="sent-valid-input-box">
                                            <!-- <label for="">{{ __('admin.lastname') }}</label> -->
                                            <input type="text" name="lastname" placeholder="{{ __('admin.lastname') }}" autocomplete="off" required>
                                        </div> 
                                        <div class="sent-valid-input-box">
                                            <!-- <label for="">{{ __('admin.phone') }}</label> -->
                                            <input type="phone" name="phone" placeholder="{{ __('admin.phone') }}" autocomplete="off" required>
                                        </div>  
                                        <div class="sent-valid-input-box">
                                            <label for="">{{ __('admin.email') }}</label>
                                            <input type="email" name="email"  placeholder="{{ __('admin.email') }}" autocomplete="off" required>
                                        </div>   

                                        <div class="sent-valid-textarea-box">
                                            <label for="">{{ __('admin.text') }}</label>
                                            <textarea name="text" placeholder="{{ __('admin.text') }}" autocomplete="off" required></textarea>
                                        </div>   
                                        <div class="upload-files">
                                            <div class="files_10">
                                                <div class="upload-scale-box">
                                                    <span> 
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="39.274" height="43.43" viewBox="0 0 39.274 43.43">
                                                            <g id="attach" transform="translate(-64.084 -5.475)">
                                                            <path id="Path_224" data-name="Path 224" d="M100.67,98H77.153a3.07,3.07,0,0,0-3.07,3.07v35.2a3.07,3.07,0,0,0,3.07,3.07h31.089a3.07,3.07,0,0,0,3.07-3.07V108.641Z" transform="translate(-8.976 -91.456)" fill="#fff"/>
                                                            <path id="Path_225" data-name="Path 225" d="M344.558,108.641h-7.316a3.325,3.325,0,0,1-3.325-3.325V98Z" transform="translate(-242.223 -91.456)" fill="#e5bc62"/>
                                                            <path id="Path_229" data-name="Path 229" d="M213.828,244H196.217a1.029,1.029,0,1,0,0,2.046h17.611a1.029,1.029,0,1,0,0-2.046Z" transform="translate(-123.268 -220.882)" fill="#4c8a9d"/>
                                                            <path id="Path_230" data-name="Path 230" d="M213.828,316H196.217a1.029,1.029,0,1,0,0,2.047h17.611a1.029,1.029,0,1,0,0-2.047Z" transform="translate(-123.268 -285.515)" fill="#4c8a9d"/>
                                                            <path id="Path_231" data-name="Path 231" d="M213.828,388H196.217a1.029,1.029,0,1,0,0,2.046h17.611a1.029,1.029,0,1,0,0-2.046Z" transform="translate(-123.268 -350.148)" fill="#4c8a9d"/>
                                                            <path id="Path_232" data-name="Path 232" d="M103.357,17.135s0-.008,0-.012a.439.439,0,0,0-.005-.044,1.02,1.02,0,0,0-.292-.618L92.417,5.82a1.022,1.022,0,0,0-.681-.3l-.042,0H84.753c-9.381-.1-3.487.005-14.325,0H68.177a4.1,4.1,0,0,0-4.093,4.093v35.2A4.1,4.1,0,0,0,68.177,48.9H99.266a4.1,4.1,0,0,0,4.093-4.093V17.185C103.358,17.167,103.358,17.151,103.357,17.135ZM92.717,9.014l7.148,7.148H95.019a2.3,2.3,0,0,1-2.3-2.3V9.014Zm6.549,37.844H68.177a2.049,2.049,0,0,1-2.046-2.046V9.613a2.049,2.049,0,0,1,2.046-2.046H74.43c10.4.065,6.021.065,10.323,0H90.67V13.86a4.354,4.354,0,0,0,4.349,4.349h6.293v26.6A2.048,2.048,0,0,1,99.266,46.858Z" fill="#4c8a9d"/>
                                                            </g>
                                                        </svg> 
                                                    </span>
                                                    <input type="file" name="file" class="upload-file-input">
                                                </div>
                                                <span class="file-text">
                                                    {{ __('admin.upload_file') }}
                                                </span>
                                            </div>
                                            <button>{{trans('website.Send')}}</button>
                                            @if(Session::has('success'))
                                            <div class="alert alert-success">
                                                {{Session::get('success')}}
                                            </div>
                                        @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    

    <section>
        <div class="vacancy-section" style="background-image: url(/website/assets/img/vacancy-background.png)"> 
            <div class="vacancy-blur"></div>
            <div class="vacancy-cont">
                <div class="container">
                    <div class="row row_resp_vacancy">
                        <div class="col-lg-6 col-md-6   col-12">
                            <div class="vacancy-box">
                                <div class="important-title vacancy-title">
                                    <img src="/website/assets/img/title-img.png" alt="title-img">
                                   
           
                                    <h1>{{ $vacancy->translate(app()->getlocale())->title  }}</h1>
                                   
                                </div>
                             
                                <div class="vacancy-type-list">
                                    @foreach($vacancy->posts as $post)
                                    @php
                                    $count = 0; 
                                @endphp
                                   
                                    @if($post->populars == 0 && $count < 4)
                                   
                                    <a href="/{{ $post->getFullSlug() }}" class="vacancy-item">
                                        <div class="icon-vacancy">
                                            <img src="/website/assets/img/vac-0000.svg" alt="icon">
                                        </div>
                                        <span>
                                            {{$post->translate(app()->getlocale())->title}}
                                        </span>
                                    </a>
                                    @endif
                                   
                                   
                                    @endforeach
                                  
                                </div>
                            </div>
                            <div class="see-all-link resp-link-show">
                                <a href="/{{ $vacancy->getFullSlug() }}">
                                    {{ __('website.See_All') }}
                                </a>
                            </div>
                        </div>
                       
                        <div class="col-lg-6 col-md-6 col-sm-7 col-12 pos-rel">
                            @if(isset($popular_vacancy) && $popular_vacancy != '')
                            
                            <div class="vacancy-right-box">
                                <div class="vacancy-right-img">
                                    <img src="{{ image($popular_vacancy->thumb) }}" alt="vacancy-img">
                                    <div class="vacancy-time-box">
                                        {{ $popular_vacancy->start_date }} - {{ $popular_vacancy->end_date }}
                                    </div>
                                </div>
                                <div class="vacancy-context">
                                    <h1>{{ $popular_vacancy->translate(app()->getlocale())->title }}</h1>
                                    <div class="text">
                                        {!!$popular_vacancy->translate(app()->getlocale())->desc   !!}
                                    </div>
                                    <ul class="vacancy-ul ">

                                        <div class="vacancy-li">

                                            <span class="icon-placeholder"></span>

                                            <a>{{ $popular_vacancy->translate(app()->getlocale())->adress }} </a>

                                        </div>

                                        <div class="vacancy-li">

                                            <span class="icon-money"></span>

                                            <a>{{ $popular_vacancy->translate(app()->getlocale())->workin_hours }}</a>

                                        </div>

                                        <div class="vacancy-li">

                                            <span class="icon-clock"></span>

                                            <a>{{ $popular_vacancy->translate(app()->getlocale())->position }}</a>

                                        </div>

                                        <div class="vacancy-li">

                                            <span class="icon-graduation-cap"></span>

                                            <a>{{ $popular_vacancy->translate(app()->getlocale())->daily_pay }}</a>

                                        </div>

                                        <div class="vacancy-li">

                                            <span class="icon-office-chair"></span>

                                            <a>{{ $popular_vacancy->translate(app()->getlocale())->Vacant_place }}</a>

                                        </div>

                                        </ul>
                                    <div class="vacancy-dots">
                                        <a href="/{{ $popular_vacancy->getFullSlug() }}">
                                            <img src="/website/assets/img/blue-dots.png" alt="dots">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="vacancy-right-box">
                                <div class="vacancy-right-img">
                                    <img src="{{ image($vacancy->posts[0]->thumb) }}" alt="vacancy-img">
                                    <div class="vacancy-time-box">
                                        {{ $vacancy->posts[0]->start_date }} - {{ $vacancy->posts[0]->end_date }}
                                    </div>
                                </div>
                                <div class="vacancy-context">
                                    <h1>{{ $vacancy->posts[0]->translate(app()->getlocale())->title }}</h1>
                                    <div class="text">
                                        {!!$vacancy->posts[0]->translate(app()->getlocale())->desc   !!}
                                    </div>
                                    <ul class="vacancy-ul">
                                        <div class="vacancy-li">
                                            <span class="icon-placeholder"></span>
                                            <a href="#">{{ $vacancy->posts[0]->translate(app()->getlocale())->adress }} </a>
                                        </div>
                                        <div class="vacancy-li">
                                            <span class="icon-money"></span>
                                            <a href="#">{{ $vacancy->posts[0]->translate(app()->getlocale())->daily_pay }}</a>
                                        </div>
                                        <div class="vacancy-li">
                                            <span class="icon-clock"></span>
                                            <a href="#">{{ $vacancy->posts[0]->translate(app()->getlocale())->wirkin_hours }}</a>
                                        </div>
                                        <div class="vacancy-li">
                                            <span class="icon-graduation-cap"></span>
                                            <a href="#">{{ $vacancy->posts[0]->translate(app()->getlocale())->vacant_place }}</a>
                                        </div>
                                        <div class="vacancy-li">
                                            <span class="icon-office-chair"></span>
                                            <a href="#">{{ $vacancy->posts[0]->translate(app()->getlocale())->position }} (Kassierer/in)</a>
                                        </div>
                                    </ul>
                                    <div class="vacancy-dots">
                                        <a href="/{{ $vacancy->posts[0]->getFullSlug() }}">
                                            <img src="/website/assets/img/blue-dots.png" alt="dots">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                         
                           
                            <div class="see-all-link">
                                <a href="/{{ $vacancy->getFullSlug() }}">
                                    {{ __('website.See_All') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </section>

   </main>
@endsection
