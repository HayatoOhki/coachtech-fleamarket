<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'post_code' => 'required|regex:/^\d{3}-?\d{4}$/',
            'address' => 'required|max:255',
            'building' => 'max:255',
        ];
    }
    
    public function messages() {
        return [
            'post_code.required' => '郵便番号を入力してください',
            'post_code.regex' => '郵便番号を半角数字7桁で入力してください',
            'address.required' => '住所を入力してください',
            'address.max' => '文字数制限を超えています',
            'building.max' => '文字数制限を超えています',
        ];
    }
}
