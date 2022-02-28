<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterStoreImagesRequest extends FormRequest
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
            'category1'   => Rule::in(['foods', 'drinks', 'others']),
            'storeimage1' => 'required_without_all:storeimage2,storeimage3|file|image|mimes:jpg,jpeg,png|max:1024',
            'category2'   => Rule::in(['foods', 'drinks', 'others']),
            'storeimage2' => 'nullable|file|image|mimes:jpg,jpeg,png|max:1024',
            'category3'   => Rule::in(['foods', 'drinks', 'others']),
            'storeimage3' => 'nullable|file|image|mimes:jpg,jpeg,png|max:1024',
            'store_id'    => 'exists:stores,id',
        ];
    }

    public function messages()
    {
        return [
            'category1.in'    => '料理、ドリンク、その他のいずれかを選択してください。',
            'category2.in'    => '料理、ドリンク、その他のいずれかを選択してください。',
            'category3.in'    => '料理、ドリンク、その他のいずれかを選択してください。',
            'storeimage1.required_without_all' => '写真を設定してください。',
            'store_id.exists' => '問題が発生しました。再度操作をやり直してください。',
        ];
    }

    public function attributes()
    {
        return [
            'storeimage1' => '写真',
            'storeimage2' => '写真',
            'storeimage3' => '写真',
        ];
    }
}
