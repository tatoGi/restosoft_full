

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            @foreach($locales as $locale => $url)
            <li class="leng">
    
                <a class="active" title="{{ trans('website.'.$locale) }}" href="@if(app()->getLocale() != $locale) {{$url}} @endif">
    
                    <div class="language-text">
                        {{ trans('website.'.$locale) }}
                    </div>
    
                </a>
    
            </li>
            @endforeach
{{--     
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" title="notifications"  role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    @if (count($notifications) > 0)
                    <span class="badge badge-danger rounded-circle noti-icon-badge">{{ count($notifications) }}</span>

                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            {{ trans('admin.notifications') }}
                        </h5>
                    </div>

                    <div class="slimscroll noti-scroll">

                        @foreach ($notifications as $notif)
                            <a href="/{{ app()->getLocale() }}/admin/submission/{{ $notif->id }}"  class="dropdown-item notify-item active">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-email"></i>
                                </div>
                                <p class="notify-details">
                                    {{ $notif->post->parent->title }}
                                </p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>{{ $notif->name }}</small>
                                </p>
                            </a>
                        @endforeach



                    </div>

                    <!-- All-->
                    <a href="/{{ app()->getLocale() }}/admin/submissions" class="dropdown-item text-center text-primary notify-item notify-all">
                        {{ trans('admin.view_all') }}
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>
            <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" title="subscribes"  role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    @if (count($subscribes) > 0)
                    <span class="badge badge-danger rounded-circle noti-icon-badge">{{ count($subscribes) }}</span>

                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            {{ trans('admin.subscribes') }}
                        </h5>
                    </div>

                    <div class="slimscroll noti-scroll">

                        @foreach ($subscribes as $subscribe)
                            <a href="/{{ app()->getLocale() }}/admin/subscribes" class="dropdown-item notify-item active">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-email"></i>
                                </div>
                                <p class="notify-details">
                                    {{ $subscribe->email }}
                                </p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>{{ $subscribe->created_at }}</small>
                                </p>
                            </a>
                        @endforeach



                    </div>

                    <!-- All-->
                    <a href="/{{ app()->getLocale() }}/admin/subscribes" class="dropdown-item text-center text-primary notify-item notify-all">
                        {{ trans('admin.view_all') }}
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li> --}}
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                    <span class="pro-user-name ml-1">
                        {{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                    <a href="/{{ app()->getLocale() }}/admin/users/edit/{{  auth()->user()->id }}" class="dropdown-item notify-item">

                        <i class="fe-user"></i>
                        <span>{{ trans('admin.my_account') }}</span>
                    </a>



                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{ route('logout', app()->getLocale()) }}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>{{ trans('admin.logout') }}</span>
                    </a>

                </div>
            </li>




        </ul>



        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile disable-btn waves-effect">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <h4 class="page-title-main">@stack('name')</h4>
            </li>

        </ul>
    </div>
    <!-- end Topbar -->
