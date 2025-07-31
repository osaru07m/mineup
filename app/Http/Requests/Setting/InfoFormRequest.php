<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class InfoFormRequest extends FormRequest
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
        $user = $this->user('web');

        $emailRules = ['required', 'email'];

        if ($this->input('email') !== $user->email) {
            $emailRules[] = 'unique:users,email';
        }

        return [
            'last_name' => [
                'required',
                'string'
            ],
            'first_name' => [
                'required',
                'string'
            ],
            'email' => $emailRules,
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
