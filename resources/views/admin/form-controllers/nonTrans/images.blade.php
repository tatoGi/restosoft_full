<div class="form-group">
    <label>{{ trans('admin.'.$key) }}</label> <br>
    <div class="upload-box" data-name="files[{{ $key }}]"
        data-action="/{{ app()->getLocale().'/admin/upload/image?_token='. csrf_token() }}"
        data-delete="{{ route('image.del', app()->getLocale(), ['_token' => csrf_token()]) }}">
        {{ Form::hidden('thumb', null) }}
        <ul></ul>
        @if (isset($model->files))
        @foreach ($model->files as $file)

        <li class="old">
            <div class="close-it"
                data-delete="{{ route('image.del', app()->getLocale(), ['_token' => csrf_token()]) }}"></div>
            <input type="hidden" name="old_file[{{ $file->id }}][file]" value="{{ $file->file }}">
            <img src="{{ '/' . config('config.image_path') . config('config.thumb_path') .  $file->file }}">

            <div>

                    @foreach($file->file_additional as $additional)
                        <input type="text" name="old_file[{{ $file->id }}][{{ $locale }}][file_additional]"
                               value="{{ $additional }}" class="form-control"
                               placeholder="{{ $locale }}-{{ __('admin.alt_text') }}">

                    @endforeach
                <input type="text" name="old_file[{{ $file->id }}][title]"
                       value="{{ $file->title }}" class="form-control" placeholder="youtube">
            </div>
        </li>
        @endforeach
        @endif
        </ul>
    </div>
</div>
