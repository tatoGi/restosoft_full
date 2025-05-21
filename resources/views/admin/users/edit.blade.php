@extends('admin.layouts.app')

@push('name')
    {{ trans('admin.users') }}
@endpush



@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card-box">


            <h4 class="header-title mt-0 mb-3">{{ trans('admin.edit_user') }}</h4>

            <form action="/{{ app()->getLocale() }}/admin/users/edit/{{ $user->id }}" method="post" data-parsley-validate novalidate>
                @csrf
                <div class="form-group">
                    <label for="userName">{{ trans('admin.username') }}</label>
                    @error('name')
                        <small style="display:block; color:rgb(239, 83, 80)">{{ trans('admin.username_is_required') }}</small>
                    @enderror
                    <input type="text" value="{{ $user->name }}" name="name" parsley-trigger="change" required
                           placeholder="Enter user name" class="@error('name') danger @enderror form-control" id="userName">
                </div>
                <div class="form-group">
                    <label for="emailAddress">{{ trans('admin.email') }}</label>
                    @error('email')
                        <small style="display:block; color:rgb(239, 83, 80)">{{ trans('admin.email_is_required_and_must_be_unique') }}</small>
                    @enderror
                    <input type="email" value="{{ $user->email }}" name="email" parsley-trigger="change" required
                           placeholder="Enter email" class="@error('email') danger @enderror form-control" id="emailAddress">
                </div>
                <div class="form-group">
                    <h5>{{ trans('admin.type') }}</h5>
                    @error('type_id')
                        <small style="display:block; color:rgb(239, 83, 80)">{{ trans('admin.type_is_required') }}</small>
                    @enderror

                    <select class="form-control select2 @error('type_id') danger @enderror " name="type_id">
                        @foreach ($user_types as $key => $type)
                            <option value="{{ $key }}" @if ($user->type_id == $key) selected @endif >{{ trans('admin.'.$type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pass1">{{ trans('admin.password') }}</label>
                    @error('password')
                        <small style="display:block; color:rgb(239, 83, 80)">{{ trans('admin.password_is_required_min_8_characters') }}</small>
                    @enderror
                    <input id="pass1" type="password" placeholder="Password"
                           class="form-control @error('password') danger @enderror" name="password">
                </div>
                <div class="form-group">
                    <label for="passWord2">{{ trans('admin.re_password') }}</label>
                    @error('re_password')
                        <small style="display:block; color:rgb(239, 83, 80)">{{ trans('admin.re_password_must_be_same_as_password') }}</small>
                    @enderror
                    <input data-parsley-equalto="#pass1" type="password"
                           placeholder="Password" name="re_password" class="form-control @error('re_password') danger @enderror" id="passWord2">
                </div>


                <div class="form-group text-right mb-0">
                    <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="{{ asset('/admin/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .danger{
            border: 1px solid rgb(239, 83, 80) !important;
        }
    </style>
@endpush

@push('scripts')

    <script src="{{ asset('/admin/assets/libs/parsleyjs/parsley.min.js') }}"></script>

    <!-- validation init -->
    <script src="{{ asset('/admin/assets/js/pages/form-validation.init.js') }}"></script>
@endpush
