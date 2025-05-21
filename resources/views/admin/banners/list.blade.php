@extends('admin.layouts.app')

@push('name')
{{ trans('bannerTypes.'.$type['name']) }}
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
           
            <div style="display: flex; align-items:center; justify-content: space-between; padding:20px 0">
                <h4 class="mt-0 header-title float-left">{{ trans('admin.banners') }}</h4>
              
                @if($type['id'] == 2 && count($banners) >= 2)
                <a href="{{ route('banner.create', [app()->getLocale(), $type['id']]) }}" type="button" class="float-right btn btn-info waves-effect width-md waves-light none">{{ trans('admin.add_banner') }}</a>
            @else
                <a href="{{ route('banner.create', [app()->getLocale(), $type['id']]) }}" type="button" class="float-right btn btn-info waves-effect width-md waves-light">{{ trans('admin.add_banner') }}</a>
            @endif
            </div>

            <div class="container-fluid">

                <div class="row">

                    @foreach ($banners as $banner)
                        <div class="col-xl-4 col-md-6">
                            <div class="card-box">
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a style="color: #ff3535"  href="{{ route('banner.edit', [app()->getLocale(), $banner->id]) }}" class="dropdown-item">{{ trans('admin.edit') }}</a>
                                        <a style="color: #ff3535" href="{{ route('banner.destroy', [app()->getLocale(), $banner->id]) }}" onclick="return confirm('დარწმნებლი ხართ რომ გსურთ ბანერის სექციის წაშლა ?');" class="dropdown-item">{{ trans('admin.delete') }}</a>


                                    </div>
                                </div>
                                <h4 class="header-title mt-0 "><small>{{ $banner->translate(app()->getLocale())->title }}</small></h4>
                                 @if(isset($banner->thumb) && ($banner->thumb != ''))
                                <img class="img-fluid card-image" style="object-fit: contain" src="/uploads/img/{{ $banner->thumb }}" alt="Card image cap">
                                @else
                                <img class="img-fluid card-image" style="object-fit: contain" src="/uploads/img/{{ $banner->translate(app()->getlocale())['image'] }}" alt="Card image cap">
                                 @endif
                           <p>{{ substr(strip_tags($banner->desc), 0, 230) }}</p>
                                    </div>

                        </div><!-- end col -->
                    @endforeach
                    <div class="col-lg-12">
                        {{ $banners->links() }}
                    </div>
                </div>
              <!-- end row -->
          </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
 <style>
    .none{
        display: none;
    }
</style>   
@endpush


