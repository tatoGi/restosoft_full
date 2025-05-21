@extends('website.layout')
@section('content')
<div class="container cover-contaoner">
    <div class="row">
        <div class="contact-page-cover-img">
        <div class="contact-page-cover-img">
            @if($post->thumb == false)
            <img src="/website/img/newscoverimg.png" alt="">
            @else
            <a data-fancybox="demo" data-src="{{image($post->thumb)}}" data-caption="">
            <img src="{{ image($post->thumb) }}" alt="">
            </a>
            @endif
        </div>
        </div>
    </div>
</div>
<section class="contact-content">
    <div class="container">
        <div class="row">
            <div class="titlecontact">
                <a href=""><span></span>{{strtoupper($post->translate(app()->getLocale())->title)}}</a>
            </div>
            <div class="content">
                <div class="inner1">
                    <a href="{{settings('address_link')}}" target="blank"><span class="icon-pin"></span>{{settings('address')}}</a>
                    {{-- <a href="callto:{{settings('phone')}}"><span class="icon-phone"></span>{{settings('phone')}}</a> --}}
                    <a href="mailto:{{settings('email_link')}}" target="blank"><span class="icon-mail" ></span>{{settings('email')}}</a>


                    <a href="callto:{{settings('skype_organisation')}}" target="blank"><span
                            class="icon-skype"></span>{{trans('website.skype_organisation')}}</a>
                    <a href="callto:{{settings('skype_technical')}}" target="blank"><span
                            class="icon-skype"></span>{{trans('website.skype_technical')}}</a>
                </div>
                <div class="inner2">
                    <form method="POST">
                        @csrf
                        <div class="formleft">
                            <input type="text" placeholder="Name" name="name" required>
                            <input type="text" placeholder="Theme" name="theme" required>
                            <input type="email" placeholder="Your e-mail" name="email" required>
                        </div>
                        <div class="formright">
                            <textarea name="text" placeholder="Message" required></textarea>
                            <button>{{trans('website.Send')}}</button>
                        </div>
                    </form>
                    @if(Session::has('message'))
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</section>
<div class="container cover-contaoner">
    <div class="row">
    {!! settings('Iframe') !!}
    </div>
</div>
@endsection
