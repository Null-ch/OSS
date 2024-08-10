<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'middle_name' => 'string|max:255',
            'name' => 'required|string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => [
                'required',
                'string',
                Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),
            ]
        ];
    }

    /**
     * Receiving messages in case of validation error
     *
     * @return array
     * 
     */
    public function messages()
    {
        return [
            'middle_name.string' => 'Поле должно быть строкой',
            'name.string' => 'Поле должно быть строкой',
            'name.required' => 'Поле обязательно для заполнения',
            'last_name.string' => 'Поле должно быть строкой',
            'email.string' => 'Поле должно быть строкой',
            'email.required' => 'Это поле должно быть заполнено',
            'email.email' => 'Почта должна быть в формате example@mail.ru',
            'email.unique' => 'Email уже занят',
            'password.min' => 'Минимальная длина пароля 8 символов',
            'password.max' => 'Максимальная длина пароля 15 символов',
        ];
    }
}
