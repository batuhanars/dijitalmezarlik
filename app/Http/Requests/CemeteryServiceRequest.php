<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CemeteryServiceRequest extends FormRequest
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
            "image" => "max:2048",
            "title" => "required",
            "short_description" => "required",
            "content" => "required",
        ];
    }

    public function messages()
    {
        return [
            "image.max" => "Resim boyutu maximum 2mb olmalıdır",
            "title.required" => "Başlık alanı gereklidir!",
            "short_description.required" => "Kısa Açıklama alanı gereklidir!",
            "content.required" => "İçerik alanı gereklidir!",
        ];
    }
}
