<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuggestionComplaintRequest extends FormRequest
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
            "name" => "required",
            "email" => "required",
            "title" => "required",
            "topic" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Ad Soyad alanı gereklidir",
            "email.required" => "Email alanı gereklidir",
            "title.required" => "Konu Başlık alanı gereklidir",
            "topic.required" => "Konu alanı gereklidir",
        ];
    }
}
