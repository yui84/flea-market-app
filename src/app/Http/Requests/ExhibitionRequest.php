<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'item_name' => 'required',
            'item_detail' => 'required | max:255',
            'item_image' => 'required | mimes:png,jpeg',
            'item_category' => 'required',
            'state_id' => 'required',
            'item_price' => 'required | integer | min:0'
        ];
    }

    public function messages()
    {
        return [
            'item_name.required' => '商品名を入力してください',
            'item_detail.required' => '商品の説明を入力してください',
            'item_detail.max' => '商品の説明は255文字以内で入力してください',
            'item_image.required' => '商品画像をアップロードしてください',
            'item_image.mimes:png,jpeg' => '商品画像は「.png」または「.jpeg」形式でアップロードしてください',
            'item_category.required' => '商品のカテゴリーを選択してください',
            'state_id.required' => '商品の状態を選択してください',
            'item_price.required' => '商品価格を入力してください',
            'item_price.integer' => '商品価格は数値で入力してください',
            'item_price.min' => '商品価格は0円以上で入力してください'
        ];
    }
}
