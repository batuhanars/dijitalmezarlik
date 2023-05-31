<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeDeceasedRequest extends FormRequest
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
            // "province_id" => "required",
            // "district_id" => "required",
            // "neighborhood_id" => "required",
            // regex:/^[a-zA-Z]+$/u
            "first_name" => "required",
            "last_name" => "required",
            "father_name" => "required",
            "mother_name" => "required",
            "content" => "required",
        ];
    }

    public function messages()
    {
        return [
            "image.max" => "Resim boyutu maximum 2mb olmalıdır",
            // "province_id.required" => "Lütfen bir il seçiniz",
            // "district_id.required" => "Lütfen bir ilçe seçiniz",
            // "neighborhood_id.required" => "Lütfen bir mahalle seçiniz",
            "first_name.required" => "Mevta adı alanı gereklidir",
            "last_name.required" => "Mevta soyadı alanı gereklidir",
            // "full_name.regex" => "Mevta adı soyadı rakamsal değerler içermemelidir.",
            "father_name.required" => "Baba adı alanı gereklidir",
            "mother_name.required" => "Anne adı alanı gereklidir",
            "content.required" => "Mevta hakkında alanı gereklidir",
        ];
    }
}
