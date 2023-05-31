<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganisationRequest extends FormRequest
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
            "email" => "required|email",
            "tax_number" => "required",
            "address" => "required",
            "phone" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Kurum adı boş bırakılamaz",
            "email.required" => "Email adresi boş bırakılamaz",
            "email.email" => "Email adresinde @ işareti eksik lütfen bir @ işareti ekleyiniz",
            "tax_number.required" => "Vergi numarası boş bırakılamaz",
            "address.required" => "Kurum adresi boş bırakılamaz",
            "phone.required" => "İletişim numarası boş bırakılamaz",
        ];
    }
}
