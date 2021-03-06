<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperplanCreateRequest extends FormRequest
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
            'objekt'    => 'string|required|max:190',
            'opisanie'  => 'string|required|max:1000',
            'inputFile' => 'required|mimes:doc,docx,xls,xlsx,jpg,jpeg,vsd,vsdx',
        ];
    }

    /**
     * Замена стандартных сообщений об ошибках
     *
     * @return array
     */
    public function messages()
    {
        return [
            'objekt.required' => 'Поле не должно быть пустым',
            'opisanie.required'  => 'Поле не должно быть пустым',
        ];
    }
}
