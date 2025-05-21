@php
    $repeaterFields = $field['fields'] ?? [];
@endphp

<div class="form-group">
    <label>{{ trans('admin.' . $key) }}</label>
    <div class="invoice-repeater">
        <div data-repeater-list="{{ $locale }}[{{ $key }}]">
            @if (isset($post) && isset($post->translate($locale)->{$key}))
                @foreach ($post->translate($locale)->{$key} as $item)
                    <div data-repeater-item>
                        <div class="row d-flex align-items-end">
                            @foreach ($repeaterFields as $fieldKey => $fieldConfig)
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>{{ trans('admin.' . $fieldKey) }}</label>
                                        @if ($fieldConfig['type'] === 'text')
                                            <input type="text"
                                                class="form-control"
                                                name="{{ $fieldKey }}"
                                                value="{{ $item[$fieldKey] ?? '' }}"
                                                {{ isset($fieldConfig['required']) && $fieldConfig['required'] ? 'required' : '' }}>
                                        @elseif ($fieldConfig['type'] === 'number')
                                            <input type="number"
                                                class="form-control"
                                                name="{{ $fieldKey }}"
                                                value="{{ $item[$fieldKey] ?? '' }}"
                                                {{ isset($fieldConfig['required']) && $fieldConfig['required'] ? 'required' : '' }}>
                                        @elseif ($fieldConfig['type'] === 'checkbox')
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                    class="custom-control-input"
                                                    name="{{ $fieldKey }}"
                                                    value="1"
                                                    {{ isset($item[$fieldKey]) && $item[$fieldKey] ? 'checked' : '' }}
                                                    {{ isset($fieldConfig['required']) && $fieldConfig['required'] ? 'required' : '' }}>
                                                <label class="custom-control-label"></label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" data-repeater-delete>
                                        {{ trans('admin.remove') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div data-repeater-item>
                    <div class="row d-flex align-items-end">
                        @foreach ($repeaterFields as $fieldKey => $fieldConfig)
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label>{{ trans('admin.' . $fieldKey) }}</label>
                                    @if ($fieldConfig['type'] === 'text')
                                        <input type="text"
                                            class="form-control"
                                            name="{{ $fieldKey }}"
                                            {{ isset($fieldConfig['required']) && $fieldConfig['required'] ? 'required' : '' }}>
                                    @elseif ($fieldConfig['type'] === 'number')
                                        <input type="number"
                                            class="form-control"
                                            name="{{ $fieldKey }}"
                                            {{ isset($fieldConfig['required']) && $fieldConfig['required'] ? 'required' : '' }}>
                                    @elseif ($fieldConfig['type'] === 'checkbox')
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                class="custom-control-input"
                                                name="{{ $fieldKey }}"
                                                value="1"
                                                {{ isset($fieldConfig['default']) && $fieldConfig['default'] ? 'checked' : '' }}
                                                {{ isset($fieldConfig['required']) && $fieldConfig['required'] ? 'required' : '' }}>
                                            <label class="custom-control-label"></label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger" data-repeater-delete>
                                    {{ trans('admin.remove') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <button type="button" class="btn btn-primary" data-repeater-create>
            {{ trans('admin.add') }}
        </button>
    </div>
</div>
