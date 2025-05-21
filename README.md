// SectionTypoes > type
//this id is responsible for type of section type
//0 Home Page
//1 has one post. no list view, only show [ Like: About Us]
//2 has many posts but only list view, not show
//3 has many posts has list view and show view
//4 Search Page

ბანერის სტულები (bannerTypes > style) :
1: ჩვეულებრივი ბანერის გვერდი შესაძლებელი რამდენიმე ბანერის დამატება. როგორც ყველგან.
2: ბანერი რომელსაც მქოლოდ ერთი ბანერი აქვს შესაძლებელია მხოლოდ ერთის დამატება რედაქტირება




                    @foreach ($emails as $post)
                        <div class="col-xl-4 col-md-6">
                            <div class="card-box">
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        {{-- @if (count($post->submissions) > 0)
                                            <a style="color: #35b8e0"  href="/{{ app()->getLocale() }}/admin/submissions?post_id={{ $section->post()->id }}" class="dropdown-item">{{ trans('admin.submissions') }}</a>
                                        @endif --}}
                                        <a style="color: #35b8e0"  href="{{ route('email.edit', [app()->getLocale(), $post->id]) }}" class="dropdown-item">{{ trans('admin.edit') }}</a>
                                        <a style="color: #ff3535" href="{{ route('email.delete', [app()->getLocale(), $post->id]) }}" class="dropdown-item">{{ trans('admin.delete') }}</a>
                                        
    
                                    </div>
                                </div>
								
                                <h4 class="header-title mt-0 ">{{ $post->title }} <br> <small>{{ substr(str_replace("&nbsp;", '', strip_tags($post->desc)), 0, 230) }}</small><br><a href=""><i>{{$post->buttonslug}}</i></a></h4>
								<img class="img-fluid card-image" src="/{{ $post->thumb }}" alt="Card image cap">

                            </div>

                        </div>
                    @endforeach




                    
            {{-- <a href="{{ route('exportExcel', 'xls') }}"><button class="btn btn-success">Download Excel
                xls</button></a>
            <a href="{{ route('exportExcel', 'xlsx') }}"><button class="btn btn-success">Download Excel
                    xlsx</button></a>
            <a href="{{ route('exportExcel', 'csv') }}"><button class="btn btn-success">Download CSV</button></a> --}}


            
        {{-- @if($message = Session::get('success'))
        <div class="alert alert-info alert-dismissible fade in" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>{{trans('admin.file_successfully_uploaded')}}</strong>
    </div>
    @endif
    {!! Session::forget('success') !!} --}}






















            <section>
            <div class="main-banner">
                <div class="white-tringle"></div>
                <div class="yellow-tringle">
                    <img src="assets/img/tringle.png" alt="">
                </div>
                <div class="banner-slider">
                    @foreach ($main_banner as $banner)
                    <div class="slide">
                        <div class="img">
                            <img src="{{image($banner->thumb)}}" alt="">
                        </div>
                        <div class="text-background">
                            <div class="text font-20 line-30">
							{{$banner->translate(app()->getlocale())->title}}	
							</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="banners-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="key-sectors">
                                <div class="title">
                                    <a href="">
                                        <h2 class="font-32">{{$sectors_section->title}}</h2>
                                    </a>
                                </div>

                                <div class="menu">
                                    @foreach ($key_section_posts as $item)
                                    <a href="{{$item->getfullslug()}}" class="font-20 line-36">{{$item->translate(app()->getlocale())->title}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                @foreach ($key_section_posts as $key => $item)
                                @if($key  % 2 == 0)
                                <div class="col-lg-4 p-0">
                                    <div class="banner banner-w">
                                        <a href="{{$item->getfullslug()}}">
                                            <div class="img">
                                                <img src="{{image($item->thumb)}}" alt="">
                                            </div>
                                        

                                            <div class="banner-hover">
                                                <div class="img">
                                                    <img src="assets/img/construct.png" alt="">
                                                </div>

                                                <div class="text font-24 line-32">
                                                    {{$item->translate(app()->getlocale())->title}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="col-lg-4 p-0">
                                    <div class="banner-2 banner-w yellow banner-relative">
                                            
                                        <a href="{{$item->getfullslug()}}">
                                            <div class="color-side">
                                                <div class="img">
                                                    <img src="assets/img/construct.png" alt="">
                                                </div>

                                                <div class="text font-24 line-32">
                                                    {{$item->translate(app()->getlocale())->title}}
                                                </div>
                                            </div>

                                            <div class="cover">
                                                <img src="{{image($item->thumb)}}" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>