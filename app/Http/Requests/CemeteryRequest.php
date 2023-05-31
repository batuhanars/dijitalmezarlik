<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CemeteryRequest extends FormRequest
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
            "province_id" => "required",
            "district_id" => "required",
            "neighborhood_id" => "required",
            "type" => "required",
            "title" => "required",
            "address" => "required",
            "content" => "required",
        ];
    }

    public function messages()
    {
        return [
            "image.max" => "Resim boyutu maximum 2mb olmalıdır",
            "province_id.required" => "Lütfen bir il seçiniz",
            "district_id.required" => "Lütfen bir ilçe seçiniz",
            "neighborhood_id.required" => "Lütfen bir mahalle seçiniz",
            "type.required" => "Mezarlık tipi seçiniz",
            "title.required" => "Mezarlık adı alanı gerekldir",
            "address.required" => "Adres alanı gereklidir",
            "content.required" => "Tarihçe alanı gereklidir",
        ];
    }
}
