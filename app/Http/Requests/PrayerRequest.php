<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrayerRequest extends FormRequest
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
            "video_image" => "max:2048",
            "embed_code" => "required",
            "title" => "required",
            "content" => "required",
        ];
    }

    public function messages()
    {
        return [
            "video_image.max" => "Resim boyutu maximum 2mb olmalıdır",
            "embed_code.required" => "Video embed kodu alanı gereklidir",
            "title.required" => "Dua alanı gereklidir",
            "content.required" => "İçerik alanı gereklidir",
        ];
    }
}
