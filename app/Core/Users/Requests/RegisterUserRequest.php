<?php

namespace App\Core\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
            'firstname' => 'string|required',
            'lastname' => 'string|required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => Password::min(8)->mixedCase()->numbers()->required(),
            'tel' => 'string',
            'address' => 'string',
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4000'
        ];
    }
}
