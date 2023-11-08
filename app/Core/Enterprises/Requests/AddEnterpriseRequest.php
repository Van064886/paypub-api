<?php

namespace App\Core\Enterprises\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEnterpriseRequest extends FormRequest
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
            "name" => "string|required",
            "activity_sector" => "integer|exists:activity_sectors,id",
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4000'
        ];
    }
}
