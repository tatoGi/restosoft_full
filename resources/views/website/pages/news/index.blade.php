@extends('website.master')
@section('main')
<main>

    <div class="scroll-top-button">
    
    </div>
    
<section>
    <div class="_banner">
        <div class="_banner-img">
            <img src="{{ image($model->cover) }}" alt="banner">
        </div>
    </div>
</section>
        <section>
            <div class="programs-section">
                <div class="important-title">
                    <img src="/website/assets/img/title-img.png" alt="title-img">
                    <h1>{{ $model->translate(app()->getlocale())->title }}</h1>
                </div>
                <div class="container">
                    <div class="programs-box">
                        @foreach($posts as $post)
                        <a href="/{{ $post->getFullSlug() }}" class="program-item">
                            <div class="p-item" style="background-image: url('{{ image($post->thumb) }}')"></div>
                            <div class="program-text-box">
                                <h1 class="hover-title">{{ $post->translate(app()->getlocale())->title }}</h1>
                                <div class="program-text"> 
                                    <div class="p-text-icon">
                                        <img src="/website/assets/img/3.svg" alt="home">
                                    </div>
                                    <h2>{{ $post->translate(app()->getlocale())->title }}</h2>
                                    <div class="text">
                                      {!!  $post->translate(app()->getlocale())->desc !!}
                                    </div>
                                    <span>
                                        <img src="/website/assets/img/dots.svg" alt="dots">
                                    </span>
                                </div>
                            </div>
                        </a>
                       @endforeach
                    </div>
                </div>
            </div>
        </section>
     
        <section>
            <div class="vacancy-section" style="background-image: url('/website/assets/img/vacancy-background.png')"> 
                <div class="vacancy-blur"></div>
                <div class="vacancy-cont">
                    <div class="container">
                        <div class="row row_resp_vacancy">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="vacancy-box">
                                    <div class="important-title vacancy-title">
                                        <img src="/website/assets/img/title-img.png" alt="title-img">
                                       
               
                                        <h1>{{ $vacancy->translate(app()->getlocale())->title  }}</h1>
                                       
                                    </div>
                                 
                                    <div class="vacancy-type-list">
                                        @php
                                        $count = 0; 
                                    @endphp
                                        @foreach($vacancy->posts as $post)
    
                                       
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
                                    <div class="see-all-link resp-link-show">
                                        <a href="/{{ $vacancy->getFullSlug() }}">
                                        {{__('website.See_All')}}
                                        </a>
                                    </div>
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
                                        <ul class="vacancy-ul">
                                            <div class="vacancy-li">
                                                <span class="icon-placeholder"></span>
                                                <a >{{ $popular_vacancy->translate(app()->getlocale())->adress }} </a>
                                            </div>
                                            <div class="vacancy-li">
                                                <span class="icon-money"></span>
                                                <a >{{ $popular_vacancy->translate(app()->getlocale())->daily_pay }}</a>
                                            </div>
                                            <div class="vacancy-li">
                                                <span class="icon-clock"></span>
                                                <a >{{ $popular_vacancy->translate(app()->getlocale())->workin_hours }}</a>
                                            </div>
                                            <div class="vacancy-li">
                                                <span class="icon-graduation-cap"></span>
                                                <a>{{ $popular_vacancy->translate(app()->getlocale())->Vacant_place }}</a>
                                            </div>
                                            <div class="vacancy-li">
                                                <span class="icon-office-chair"></span>
                                                <a >{{ $popular_vacancy->translate(app()->getlocale())->position }} (Kassierer/in)</a>
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
                                                <a href="#">{{ $vacancy->posts[0]->translate(app()->getlocale())->workin_hours }}</a>
                                            </div>
                                            <div class="vacancy-li">
                                                <span class="icon-graduation-cap"></span>
                                                <a href="#">{{ $vacancy->posts[0]->translate(app()->getlocale())->Vacant_place }}</a>
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
                                       {{__('website.See_All')}}
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