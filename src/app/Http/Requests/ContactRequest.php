<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'gender'     => 'required|in:1,2,3',
            'email'      => 'required|email',
            'tel1'       => 'required|max:5',
            'tel2'       => 'required|max:5',
            'tel3'       => 'required|max:5',
            'address'    => 'required|string',
            'building'   => 'nullable|string',
            'detail'     => 'required|string|max:120',
            'category_id'=> 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'   => '姓を入力してください',
            'last_name.required'    => '名を入力してください',
            'gender.required'       => '性別を選択してください',
            'email.required'        => 'メールアドレスを入力してください',
            'email.email'           => 'メールアドレスはメール形式で入力してください',
            'address.required'      => '住所を入力してください',
            'detail.required'       => 'お問い合わせ内容を入力してください',
            'detail.max'        => 'お問合せ内容は120文字以内で入力してください',
            'category_id.required'  => 'お問い合わせの種類を選択してください',
        ];

    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            $tel1 = $this->input('tel1');
            $tel2 = $this->input('tel2');
            $tel3 = $this->input('tel3');

            if(!$tel1 || !$tel2 || !$tel3){
                $validator->errors()->add('tel','電話番号を入力してください');
            } elseif (
                !ctype_digit($tel1) || !ctype_digit($tel2) || !ctype_digit($tel3) ||
                strlen($tel1) > 5 || strlen($tel2) > 5 || strlen($tel3) > 5
            ){
                $validator->errors()->add('tel','電話番号は5桁までの数字で入力してください');
            }
        });
    }

}
