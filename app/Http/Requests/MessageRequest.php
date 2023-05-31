<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            "phone" => "required",
            "topic" => "required",
            "message" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Ad Soyad alanı gereklidir",
            "email.required" => "Email alanı gereklidir",
            "phone.required" => "Telefon alanı gereklidir",
            "topic.required" => "Konu alanı gereklidir",
            "message.required" => "Mesaj alanı gereklidir",
        ];
    }
}
