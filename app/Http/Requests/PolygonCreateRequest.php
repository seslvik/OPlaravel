<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolygonCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'opisanie'  => 'string|required|max:1000',
            'pos_x_1'   => 'required|min:3|max:5',
            'pos_y_1'   => 'required|min:3|max:5',
            'pos_x_2'   => 'required|min:3|max:5',
            'pos_y_2'   => 'required|min:3|max:5',
            'pos_x_3'   => 'required|min:3|max:5',
            'pos_y_3'   => 'required|min:3|max:5',
        ];
    }
}
