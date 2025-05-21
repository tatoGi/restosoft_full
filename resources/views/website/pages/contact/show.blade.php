@extends('website.master')

@section('main')
<section class="contact-section">
    <div class="container">
      <h1>CONTACTS</h1>
      <div class="contact-row">
        <div class="contact-info-box">
          <div class="contact-label">Adress :</div>
          <div class="contact-value">Mari Brose Street 3</div>
          <div class="contact-label">Email :</div>
          <div class="contact-value">
            <a href="mailto:sales@restosoft.ge">sales@restosoft.ge</a>
          </div>
          <div class="contact-label">Phone :</div>
          <div class="contact-value">
            <a href="tel:+995577951309">+995 577 951 309</a>
          </div>
        </div>
        <div class="contact-map-box">
          <iframe
            src="https://www.google.com/maps?q=41.7131,44.8015&hl=en&z=16&output=embed"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <a href="#" class="demo contact-demo-btn">Request a Demo</a>
      </div>
    </div>
  </section>
@endsection