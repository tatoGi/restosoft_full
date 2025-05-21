@extends('website.master')
@section('main')

<main>

    <section class="about-banner">
        <div class="container d-flex align-items-center justify-content-center flex-column banner-content text-center text-white">
          <h1>
            Optimize. Automate. Grow – The Future of Restaurant Management Starts
            Here.
          </h1>
          <a
            href="services.html"
            class="demo mx-auto"
            role="button"
            aria-label="Request a demo of Restosoft services"
            >Request a Demo</a
          >
        </div>
      </section>

      <section class="about-section py-5" style="position:relative;">
        <div class="polygon-bg polygon-bg-1">
          <img src="{{ asset('assets/images/img/polygonabout.svg') }}" alt="polygon" />
        </div>
        <div class="polygon-bg polygon-bg-2">
          <img src="{{ asset('assets/images/img/polygonabout.svg') }}" alt="polygon" />
        </div>
        <div class="polygon-bg polygon-bg-3">
          <img src="{{ asset('assets/images/img/polygonabout.svg') }}" alt="polygon" />
        </div>
        <div class="polygon-bg polygon-bg-4">
          <img src="{{ asset('assets/images/img/polygonabout.svg') }}" alt="polygon" />
        </div>
        <div class="polygon-bg polygon-bg-5">
          <img src="{{ asset('assets/images/img/polygonabout.svg') }}" alt="polygon" />
        </div>
        <div class="polygon-bg polygon-bg-6">
          <img src="{{ asset('assets/images/img/polygonabout.svg') }}" alt="polygon" />
        </div>
        <div class="polygon-bg polygon-bg-7">
          <img src="{{ asset('assets/images/img/polygonabout.svg') }}" alt="polygon" />
        </div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <h2
                class="font-weight-bold mb-4 about-heading-custom text-left"
                style="
                  color: #6c758a;
                  font-size: 56px;
                  font-family: 'Montserrat', Arial, sans-serif;
                  font-weight: 800;
                  letter-spacing: 0.5px;
                "
              >
                {{ $post->translate(app()->getLocale())->title }}
              </h2>
              <p
                class="mb-3 about-paragraph-custom"
                style="
                  font-size: 26px;
                  color: #232629;
                  font-family: 'Montserrat', Arial, sans-serif;
                  font-weight: 400;
                "
              >
                {!! $post->translate(app()->getLocale())->desc !!}
              </p>
              <p
                class="mb-5 about-paragraph-custom"
                style="
                  font-size: 26px;
                  color: #232629;
                  font-family: 'Montserrat', Arial, sans-serif;
                  font-weight: 400;
                "
              >
                {!! $post->translate(app()->getLocale())->text !!}
              </p>
            </div>

          </div>
          <div class="row justify-content-center align-items-center mb-5">
            <div class="col-md-10 text-center position-relative">
              <img
                src="{{ image($post->thumb) }}"
                alt="Syrve Laptop Screenshot"
                class="img-fluid"
                style="
                  position: relative;
                  z-index: 1;
                  max-width: 540px;
                  margin: 0 auto;
                  display: block;
                "
              />
               <p
                class="mb-5 about-paragraph-custom"
                style="
                  font-size: 26px;
                  color: #232629;
                  font-family: 'Montserrat', Arial, sans-serif;
                  font-weight: 400;
                "
              >
                {!! $post->translate(app()->getLocale())->text !!}
              </p>
            </div>

          </div>
        </div>
      </section>
      <div class="about-phone-footer-wrapper">
        <img
          src="{{ asset('assets/images/img/aboutphone.png') }}"
          alt="Syrve Mobile Screenshot"
          class="img-fluid about-phone-footer-img"
        />
      </div>
   </main>

    @endsection