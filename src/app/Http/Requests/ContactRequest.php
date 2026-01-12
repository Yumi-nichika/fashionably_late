<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'last_name' => 'required|string|max:8',
            'first_name' => 'required|string|max:8',
            'gender' => 'required',
            'email' => 'required|string|email|max:255',
            'telone' => 'required|numeric|digits_between:1,5',
            'teltwo' => 'required|numeric|digits_between:1,5',
            'telthree' => 'required|numeric|digits_between:1,5',
            'address' => 'required',
            'category_id' => 'required|exists:categories,id',
            'detail' => 'required|max:120'
        ];
    }

    //エラーメッセージ日本語化
    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'last_name.string' => '姓を文字列で入力してください',
            'last_name.max' => '姓は8文字以内で入力してください',
            'first_name.required' => '名を入力してください',
            'first_name.string' => '名を文字列で入力してください',
            'first_name.max' => '名は8文字以内で入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',
            'telone.required' => '電話番号を入力してください',
            'telone.numeric' => '電話番号は 半角英数字で入力してください',
            'telone.digits_between' => '電話番号は 5桁まで数字で入力してください',
            'teltwo.required' => '電話番号を入力してください',
            'teltwo.numeric' => '電話番号は 半角英数字で入力してください',
            'teltwo.digits_between' => '電話番号は 5桁まで数字で入力してください',
            'telthree.required' => '電話番号を入力してください',
            'telthree.numeric' => '電話番号は 半角英数字で入力してください',
            'telthree.digits_between' => '電話番号は 5桁まで数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'category_id.exists' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }

    //メールアドレスの全角を半角に自動変換
    protected function prepareForValidation()
    {
        $this->merge([
            'email' => mb_convert_kana($this->email, 'as'),
        ]);
    }
}
