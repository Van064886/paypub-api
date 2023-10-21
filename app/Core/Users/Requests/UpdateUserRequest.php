<?php

namespace App\Core\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Get the user id
        $id = is_null($this->id) ? $this->user()->id : $this->id;

        // Render rules according to the user
        return [
            'firstname' => 'string',
            'lastname' => 'string',
            'email' => "email|unique:users,email,{$id},id,deleted_at,NULL",
            'tel' => 'string',
            'address' => 'string',
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4000'
        ];
    }
}
