<header class="py-3" style="background-color: #0a1e44">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo d-flex align-items-center">
        <a href="/{{ app()->getLocale() }}">
        <img
          src="{{ asset('assets/images/img/logo.png') }}"
          alt="Restosoft Logo"
          class="white-logo me-2"
        />
        </a>
      </div>
      <nav>
        <ul class="nav">
            @foreach ($sections as $section)
          <li class="nav-item">
            <a class="nav-link text-white active" href="/{{ $section->getFullSlug() }}">{{ $section->translate(app()->getLocale())->title }}</a>
          </li>
          @endforeach

        </ul>
      </nav>
      <div class="language-selector">
        <button
          id="language-button"
          class="btn btn-light d-flex align-items-center"
          data-english-flag="{{ asset('assets/images/img/🇺🇸.png') }}"
          data-georgian-flag="{{ asset('assets/images/img/🇬🇪.png') }}"
        >
          <img
            id="language-flag"
            src="{{ asset('assets/images/img/🇺🇸.png') }}"
            alt="US Flag"
            class="me-2"
            style="height: 16px"
          />
          <span id="language-text">English</span>
        </button>
      </div>
    </div>
  </header>
