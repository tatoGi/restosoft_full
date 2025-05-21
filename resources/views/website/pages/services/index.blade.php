@extends('website.master')
@section('main')
  <!-- Services/Pricing Section -->
  <section class="pricing-section">
    <div class="container">
      <h2 class="text-center">{{ $servicePost->translation->title }}</h2>
      <div class="text-center">
        {!! $servicePost->translation->desc !!}
      </div>
      <p class="text-center">
        {!! $servicePost->translation->locale_additional['description'] ?? '' !!}
      </p>
      <div
        class="container d-flex justify-content-center align-items-stretch"
        style="gap: 32px"
      >
        @if(isset($servicePost->translation->locale_additional['pricing_tiers']))
          @foreach($servicePost->translation->locale_additional['pricing_tiers'] as $tier)
            <div class="pricing-card text-center">
              <div class="pricing-title">{{ $tier['tier_name'] }}</div>
              <div class="pricing-price">{{ $tier['price'] }} <span>{{ $tier['currency_symbol'] }}</span></div>
              <div class="pricing-vat">(INCLUDING VAT)</div>
              <a href="{{ $tier['button_link'] }}" class="btn btn-info">{{ $tier['button_text'] }}</a>
            </div>
          @endforeach
        @endif
      </div>
      <!-- Decorative polygons for background -->
      <img src="{{ asset('assets/img/polygonabout.png') }}" alt="" class="polygon-left" />
      <img src="{{ asset('assets/img/polygonabout.png') }}" alt="" class="polygon-right" />
    </div>
  </section>
  <!-- End Services/Pricing Section -->

  <!-- Discount Licenses Section -->
  <section class="discount-licenses-section">
    <div class="discount-licenses-container">
      @if(isset($servicePost->translation->locale_additional['discount_tiers']))
        <div class="discount-licenses-title">
          @foreach($servicePost->translation->locale_additional['discount_tiers'] as $discount)
            {{ $discount['license_count'] }}+ LICENSES - {{ $discount['discount_percentage'] }}%<br />
          @endforeach
        </div>
        <div class="discount-licenses-vat">( including VAT )</div>
      @endif
    </div>
  </section>

  <!-- Feature Comparison Table Section -->
  <section class="feature-comparison-section">
    <div class="container">
      <div class="row pricing-features-row justify-content-center align-items-start" style="margin-top: 40px;">
        @if(isset($servicePost->translation->locale_additional['pricing_tiers']))
          @foreach($servicePost->translation->locale_additional['pricing_tiers'] as $tierIndex => $tier)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="pricing-features-card {{ $tierIndex == 1 ? 'pricing-features-card-active' : '' }}">
                <div class="pricing-features-title">{{ $tier['tier_name'] }}</div>
                <ul class="pricing-features-list">
                  @if(isset($servicePost->translation->locale_additional['service_features']))
                    @foreach($servicePost->translation->locale_additional['service_features'] as $feature)
                      <li>
                        @php
                          $valueKey = strtolower($tier['tier_name']) . '_value';
                        @endphp
                        {!! $feature[$valueKey] !!}
                      </li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>
@endsection
