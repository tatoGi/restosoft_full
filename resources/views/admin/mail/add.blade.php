@extends('admin.layouts.app')

{{-- @push('name')
   {{ $section->title }}
@endpush --}}

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card-box">
            <h4 class="header-title mt-0 mb-3">{{ trans('admin.add_post') }}</h4>
            <label for="select">Choose Template</label>
            <select id="templateselector" class="form-select">
                <option value="1" id="temp1">temp1</option>
                <option value="2">temp2</option>
                <option value="3">temp3</option>
             </select>
            <form class="emailers-form"  action="/{{ app()->getLocale() }}/admin/mailers/store" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="image">title</label>
                <input type="text"  name="title" placeholder="">

                <label for="image">Description</label>
                <input type="text" name="desc" placeholder="">

                <label for="image">Slug</label>
                <input type="text" name="buttonslug" placeholder="">

                <label for="image">Text</label>
                <textarea type="text" name="text" placeholder=""></textarea>

                <div class="content-3 hiddenInputs">
                    <label for="address">Official web page</label>
                    <input type="text" name="official_web_page" id="">
                    
                    <label for="address">Place for venue:</label>
                    <input type="text" name="place_for_venue" id="">

                    <label for="address">Dates:</label>
                    <input type="text" name="dates" id="">

                    <label for="address">Conference Organize: </label>
                    <input type="text" name="conference_organize" id="">
                    
                    <label for="address">Conference Manager: </label>
                    <input type="text" name="conference_manager" id="">
                    
                    <label for="address">Conference Administrator :</label>
                    <input type="text" name="conference_administrator" id="">
                    
                    <label for="address">Contact Phone:</label>
                    <input type="text" name="contact_phone" id="">
                    
                    <label for="address">Contact E-mail :</label>
                    <input type="text" name="contact_email" id="">
                </div>
                
                <div class="form-group">
                    <label for="image">Choose Image</label>
                    <input id="image" type="file" name="thumb">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#templateselector').on('change', function(){
            $('.hiddenInputs').removeClass('shown');
            $('.content-'+$(this).val()).addClass('shown');
        });
    </script>
    <style>
        .hiddenInputs{
            display: none
        }
        .shown{
            display: block;
        }
    </style>
@endpush

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


    <link href="{{ asset('/admin/css/dropupload.css') }}">
    
    <style>
        .danger{
            border: 1px solid rgb(239, 83, 80) !important;
        }

        .emailers-form input{
            width: 100%;
            height: 40px;
            border: 1px solid #ced4da;
        }
        .emailers-form label{
                margin-top: 5px
            }
        .card-box{
            height: 600px;
        }
        
    </style>
@endpush

@push('scripts')
    

    <!-- Validation js (Parsleyjs) -->
    <script src="{{ asset('admin/libs/parsleyjs/parsley.min.js') }}"></script>

    <!-- validation init -->
    <script src="{{ asset('admin/js/pages/form-validation.init.js') }}"></script>

   
    <!-- init js -->
    {{-- <script src="{{ asset('admin/js/pages/form-editor.init.js') }}"></script> --}}


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