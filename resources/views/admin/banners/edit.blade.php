@extends('admin.layouts.app')

@push('name')
{{ trans('bannerTypes.'.$type['name']) }}
@endpush

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card-box">
          
            <h4 class="header-title mt-0 mb-3">{{ trans('admin.edit_banner') }}</h4>
            {!! Form::model($post = $banner, ['route' => ['banner.update', app()->getLocale(), $banner->id], "enctype" => "multipart/form-data"]) !!}
                @include('admin.banners.form')
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="{{ asset('/admin/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Plugins css -->
    <link href="{{ asset('/admin/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('/admin/libs/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/admin/libs/multiselect/multi-select.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/admin/libs/switchery/switchery.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('/admin/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/libs/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">




    <style>
        .danger{
            border: 1px solid rgb(239, 83, 80) !important;
        }

    </style>
@endpush

@push('scripts')
<script>
    $('.unique-slug').on( "blur",function (){
    const $input = $(this);
    const locale = $input.data('locale');
    const slug = $input.val();
    const id = $input.data('id') || null; 
    
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'POST',
        url:("/{{ app()->getLocale() }}/admin/check-slug-banner"),
        data: {slug: slug, _token: token, locale, id},
        success: function(data) {
            console.log('ok')
            $input.parent().find('.print-error-msg').html('').css('color', '');
            const btn = $('#banner-button'); 
            btn.css('pointer-events', 'initial');
        },
        error: function(data) {
            console.log(data)
            $input.parent().find('.print-error-msg').html(data.responseJSON.error).css('color', 'red');
            const btn = $('#banner-button');
            btn.css('pointer-events', 'none');
        }
    });
});

  </script>

    <!-- Validation js (Parsleyjs) -->
    <script src="{{ asset('/admin/libs/parsleyjs/parsley.min.js') }}"></script>

    <!-- validation init -->
    <script src="{{ asset('/admin/js/pages/form-validation.init.js') }}"></script>


    <!-- init js -->
    <script src="{{ asset('/admin/js/pages/form-editor.init.js') }}"></script>


    <!-- Plugins Js -->
    <script src="{{ asset('/admin/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/multiselect/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('/admin/libs/jquery-quicksearch/jquery.quicksearch.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/jquery-mask-plugin/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/admin/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/admin/libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('/admin/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>


    {{-- image Upload --}}
    <script src="{{ asset('/admin/js/dropupload.js') }}"></script>



    <!-- Init js-->
    <script src="{{ asset('/admin/js/pages/form-advanced.init.js') }}"></script>

@endpush
