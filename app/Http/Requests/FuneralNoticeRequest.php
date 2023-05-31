<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuneralNoticeRequest extends FormRequest
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
            "owner" => "required",
            // "province_id" => "required",
            // "district_id" => "required",
            // "neighborhood_id" => "required",
            "cemetery" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "mosque" => "required",
            "funeral_time" => "required",
            "funeral_hour" => "required",
            "date_of_death" => "required",
        ];
    }

    public function messages()
    {
        return [
            "owner.required" => "İlan sahibi adı soyadı gerekli",
            // "province_id.required" => "İl seçiniz",
            // "district_id.required" => "İlçe seçiniz",
            // "neighborhood_id.required" => "Mahalle seçiniz",
            "cemetery.required" => "Mezarlık alanı gereklidir",
            "first_name.required" => "Ad alanı gereklidir",
            "last_name.required" => "Soyad alanı gereklidir",
            "mosque.required" => "Camii alanı gereklidir",
            "funeral_time.required" => "Cenaze vakti seçiniz",
            "funeral_hour.required" => "Cenaze saati gereklidir",
            "date_of_death.required" => "Ölüm tarihi alanı gereklidir",
        ];
    }
}
