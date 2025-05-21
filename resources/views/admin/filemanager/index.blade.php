@extends('admin.layouts.app')









@section('content')


<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div style="display: flex; align-items:center; justify-content: space-between; padding:20px 0">
                <h4 class="mt-0 header-title float-left">{{ trans('admin.posts') }}</h4>

                {{-- <a  href="/{{ app()->getLocale() }}/admin/section/{{ $section->id }}/posts/create" type="button" class="float-right btn btn-info waves-effect width-md waves-light">{{ trans('admin.add_post') }}</a>
             --}}
            </div>

            <div class="container-fluid">

                <div class="row">

                    @foreach ($sections as $section)
                        <div class="col-xl-4 col-md-6">
                            <div class="card-box">
                          
                                <b>{{$section->title}} <a href="/{{ app()->getLocale() }}/cover/create{{$section->id}}" class="btn btn-primary">Add Cover</a> </b>

                            
                            </div>

                        </div><!-- end col -->
                    @endforeach
                </div>
              <!-- end row -->
          </div>
        </div>
    </div>
</div>
@endsection


