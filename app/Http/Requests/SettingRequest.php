<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            "dark_logo" => "max:1024",
            "white_logo" => "max:1024",
            "favicon" => "max:1024",
            "pages_image" => "max:1024",
        ];
    }

    public function messages()
    {
        return [
            "dark_logo.max" => "Siyah Logo boyutu maximum 1mb olmalıdır",
            "white_logo.max" => "Beyaz Logo boyutu maximum 1mb olmalıdır",
            "favicon.max" => "Favicon boyutu maximum 1mb olmalıdır",
            "pages_image.max" => "Sayfa arka plan resmi boyutu maximum 1024mb olmalıdır",
        ];
    }
}
