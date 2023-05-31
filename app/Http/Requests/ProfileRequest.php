<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            "full_name" => "required",
            "email" => "required|email",
            "phone" => "required",
            "address" => "required",
        ];
    }

    public function messages()
    {
        return [
            "image.max" => "Resim boyutu maximum 2mb olmalıdır",
            "full_name.required" => "Ad Soyad alanı gereklidir",
            "email.required" => "Email alanı gereklidir",
            "email.email" => "Email adresinde @ işareti eksik lütfen bir @ işareti ekleyiniz",
            "phone.required" => "Telefon alanı gereklidir",
            "address.required" => "Adres alanı gereklidir",
        ];
    }
}
