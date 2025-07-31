<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'login' => [
                'required',
                'string',
                'unique:users,login'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
                'confirmed'
            ],
            'last_name' => [
                'required',
                'string'
            ],
            'first_name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'language' => [
                'required',
                'string'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'login.required' => 'ログインIDは必須です。',
            'login.string' => 'ログインIDは文字列で入力してください。',
            'login.unique' => 'ログインIDは既に利用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.regex' => 'パスワードは英大文字・小文字・数字・記号をそれぞれ1文字以上含めてください。',
            'password.confirmed' => '確認用パスワードが一致しません。',
            'last_name.required' => '姓は必須です。',
            'last_name.string' => '姓は文字列で入力してください。',
            'first_name.required' => '名は必須です。',
            'first_name.string' => '名は文字列で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'language.required' => '使用言語は必須です。',
            'language.string' => '使用言語は文字列で入力してください。'
        ];
    }
}
