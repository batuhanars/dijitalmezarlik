<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            "comment_full_name" => "required",
            "comment_email" => "required",
            "comment_title" => "required",
            "comment_message" => "required",
        ];
    }

    public function messages()
    {
        return [
            "comment_full_name.required" => "Yorum Ad Soyad gereklidir",
            "comment_email.required" => "Yorum Email gereklidir",
            "comment_email.email" => "Yorum Email adresinde @ işareti eksik lütfen bir @ işareti ekleyiniz",
            "comment_title.required" => "Yorum başlığı gereklidir",
            "comment_message.required" => "Yorum Mesajı gereklidir",
        ];
    }
}
