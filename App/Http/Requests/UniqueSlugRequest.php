<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UniqueSlugRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => 'required',
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('sections')->where(function ($query) {
                    return $query->where('type_id', $this->type_id);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => trans('admin.slug_already_exists'),
        ];
    }
}
