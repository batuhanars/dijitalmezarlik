<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppFeatureRequest extends FormRequest
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
            "icon" => "max:2048",
            "title" =>  "required",
            "description" =>  "required",
        ];
    }

    public function messages()
    {
        return [
            "icon.max" => "İkon boyutu maximum 2mb olmalıdır",
            "title.required" => "Başlık alanı gereklidir!",
            "description.required" => "Kısa Açıklama alanı gereklidir!",
        ];
    }
}
