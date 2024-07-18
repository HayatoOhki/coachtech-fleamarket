<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'category_id' => 'required',
            'condition_id' => 'prohibited_if:condition_id,null',
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'price' => 'required',
            'upload_file.item_images.0' => 'required',
        ];
    }
    
    public function messages() {
        return [
            'category_id.required' => 'カテゴリ―を選択してください',
            'condition_id.prohibited_if' => '商品の状態を選択してください',
            'name.required' => '商品名を入力してください',
            'name.max' => '文字数制限を超えています',
            'brand.required' => 'ブランド名を入力してください',
            'brand.max' => '文字数制限を超えています',
            'price.required' => '販売価格を入力してください',
            'upload_file.item_images.0.required' => '画像を選択してください',
        ];
    }
}
