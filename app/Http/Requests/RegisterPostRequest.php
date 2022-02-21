<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (int)$this->user_id === Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'evaluation1' => 'required|integer|between:0,5',
            'evaluation2' => 'required|integer|between:0,5',
            'evaluation3' => 'required|integer|between:0,5',
            'evaluation4' => 'required|integer|between:0,5',
            'evaluation5' => 'required|integer|between:0,5',
            'title'       => 'required|string|between:1,100',
            'message'     => 'required|string|between:1,10000',
            'user_id'     => 'required',
            'store_id'    => [
                'required',
                Rule::unique('posts')->where(function($query) {
                    return $query->where('user_id', $this->user_id);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'  => '問題が発生しました。再度操作をやり直してください。',
            'store_id.required' => '問題が発生しました。再度操作をやり直してください。',
            'store_id.unique'   => '問題が発生しました。再度操作をやり直してください。',
        ];
    }

    public function attributes()
    {
        return [
            'message' => '本文',
        ];
    }

    public function passedValidation()
    {
        $evaluation1 = $this->evaluation1;
        $evaluation2 = $this->evaluation2;
        $evaluation3 = $this->evaluation3;
        $evaluation4 = $this->evaluation4;
        $evaluation5 = $this->evaluation5;

        $eva_average  = ($evaluation1 + $evaluation2 + $evaluation3 + $evaluation4 + $evaluation5) / 5;

        $this->merge(['eva_average' => $eva_average]);
    }
}
