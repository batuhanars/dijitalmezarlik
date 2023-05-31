<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
            "answer_full_name" => "required",
            "answer_email" => "required",
            "answer_title" => "required",
            "answer_message" => "required",
        ];
    }

    public function messages()
    {
        return [
            "answer_full_name.required" => "Cevap Ad Soyad gereklidir",
            "answer_email.required" => "Cevap Email gereklidir",
            "answer_email.email" => "Cevap Email adresinde @ işareti eksik lütfen bir @ işareti ekleyiniz",
            "answer_title.required" => "Cevap Başlığı gereklidir",
            "answer_message.required" => "Cevap Mesajı gereklidir",
        ];
    }
}
