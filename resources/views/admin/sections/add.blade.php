@extends('admin.layouts.app')

@push('name')
{{ trans('admin.sections') }}
@endpush

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card-box">
            <h4 class="header-title mt-0 mb-3">{{ trans('admin.add_section') }}</h4>
            <form id="section-form" action="/{{ app()->getLocale() }}/admin/sections/create" method="post"
                enctype="multipart/form-data" data-parsley-validate novalidate>
                @csrf
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <ul class="nav nav-tabs">





                    @foreach (config('app.locales') as $locale)
                    <li class="nav-item ">
                        <a href="#locale-{{ $locale }}" data-toggle="tab" aria-expanded="false"
                            class="nav-link @if($locale == app()->getLocale()) active @endif">
                            <span class="d-none d-sm-block">{{ trans('admin.locale_'.$locale) }}</span>
                        </a>
                    </li>
                    @endforeach

                </ul>
                <div class="tab-content">
                    @foreach (config('app.locales') as $locale)
                    <div role="tabpanel" class="tab-pane fade @if($locale == app()->getLocale()) active show @endif "
                        id="locale-{{ $locale }}">

                        <div class="form-group">
                            <label for="{{ $locale }}-title">{{ trans('admin.title') }}</label>
                            @error('name')
                            <small
                                style="display:block; color:rgb(239, 83, 80)">{{ trans('admin.title_is_required') }}</small>
                            @enderror
                            <input type="text" name="{{ $locale }}[title]" onchange="myFunction()"
                                parsley-trigger="change" class="@error('title') danger @enderror form-control"
                                id="{{ $locale }}-title" Required>
                        </div>

                        <div class="form-group">
                            <label for="{{ $locale }}-slug">{{ trans('admin.slug') }}</label>

                            <input type="text" name="{{ $locale }}[slug]" onchange="myFunction()" parsley-trigger="change"
                                class="@error($locale . '.slug') danger @enderror form-control  unique-slug"
                                data-locale="{{ $locale }}" id="{{ $locale }}-slug">
                            <div class="print-error-msg">
                                <ul></ul>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="{{ $locale }}-desc">{{ trans('admin.desc') }}</label>
                            <textarea id="{{ $locale }}-desc" name="{{ $locale }}[desc]"
                                class="form-control ckeditor"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="{{ $locale }}-active">{{ trans('admin.active') }}</label>
                            @error('active')
                            <small
                                style="display:block; color:rgb(239, 83, 80)">{{ trans('admin.title_is_required') }}</small>
                            @enderror
                            <br>
                            <input type="hidden" name="{{ $locale }}[active]" value="0" />
                            <input type="checkbox" name="{{ $locale }}[active]" id="{{ $locale }}-active" checked
                                value="1" data-plugin="switchery" data-color="#3bafda" />
                        </div>

                    </div>
                    @endforeach
                </div>
                <div style="padding-top:20px">
                    <div class="form-group">
                        <label for="cover">{{trans('admin.cover')}}</label>
                        <br>
                        <input type="file" name="cover" value="file_types" multiple>
                    </div>
                    <div class="form-group">
                        <label for="type">{{ trans('admin.type') }}</label>
                        @error('active')
                        <small
                            style="display:block; color:rgb(239, 83, 80)">{{ trans('admin.type_is_required') }}</small>
                        @enderror

                        <select class="form-control  @error('type') danger @enderror " name="type_id" id="typeselect">
                            @foreach ($sectionTypes as $key => $type)
                            <option value="{{ $type['id'] }}" id="typeoption">{{ trans('sectionTypes.'.$key) }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="parent">{{ trans('admin.parent') }}</label>
                        <select class="form-control" name="parent_id" id="parent">
                            <option value="">{{ trans('admin.parent') }}</option>
                            @foreach ($sections as $key => $sec)
                            <option value="{{ $sec->id }}">{{ $sec[app()->getlocale()]->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ( menuTypes() as $key => $menuType )
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" name="menu_types[]" id="type_{{ $key }}" value="{{ $key }}">
                        <label for="type_{{ $key }}">
                            {{ trans('menuTypes.'.$menuType) }}
                        </label>
                    </div>
                    @endforeach


                </div>
                <div class="form-group text-right mb-0">
                    <button id="submit-button" class="btn btn-primary waves-effect waves-light mr-1" type="submit"
                        name="save">
                        {{ trans('admin.save') }}
                    </button>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('/admin/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Plugins css -->
<link href="{{ asset('/admin/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('/admin/libs/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('/admin/libs/multiselect/multi-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admin/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/admin/libs/switchery/switchery.min.css') }}" rel="stylesheet" />

<link href="{{ asset('/admin/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('/admin/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('/admin/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
<link href="{{ asset('/admin/libs/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">




<style>
    .danger {
        border: 1px solid rgb(239, 83, 80) !important;
    }

</style>
@endpush

@push('scripts')
<script>
    function slugify(text) {
        return text.toString()
        .replace(/\s+/g, '-');
            
    }
    
   function generateSlug(title, locale) {
    var slug = slugify(title);
    $('#' + locale + '-slug').val(slug).blur();
}
    
    @foreach (config('app.locales') as $locale)
    $('#{{ $locale }}-title').on('change', function() {
        var title = $(this).val().trim();
        var slug = $('#{{ $locale }}-slug').val().trim();
        if (slug === '') {
            generateSlug(title, '{{ $locale }}');
        }
    });
@endforeach

    </script>
<script>
    $('.unique-slug').on("blur", function () {
        console.log(this)
        const $input = $(this);
        const locale = $input.data('locale');
        const slug = $input.val();
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: ("/{{ app()->getLocale() }}/admin/check-slug"),
            data: {
                slug: slug,
                _token: token,
                locale
            },
            success: function (data) {
                console.log('ok')
                $input.parent().find('.print-error-msg').html('').css('color', '');
                const btn = $('#submit-button');
                btn.css('pointer-events', 'initial');

            },
            error: function (data) {
                console.log(data)
                $input.parent().find('.print-error-msg').html(data.responseJSON.error).css('color',
                    'red');
                const btn = $('#submit-button');
                btn.css('pointer-events', 'none');
            }
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.3/dist/parsley.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- Validation js (Parsleyjs) -->
 <script src="{{ asset('admin/libs/parsleyjs/parsley.min.js') }}"></script>

 <!-- validation init -->
 <script src="{{ asset('admin/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('/admin/libs/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('/admin/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('/admin/js/pages/form-editor.init.js') }}"></script>
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




<!-- Init js-->
<script src="{{ asset('/admin/js/pages/form-advanced.init.js') }}"></script>

@endpush
