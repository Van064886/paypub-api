<?php

namespace App\Core\Enterprises\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchEnterpriseRequest extends FormRequest
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
            'name' => 'string|nullable',
            'owner' => 'integer|exists:users,id|nullable',
            'activity_sector' => 'integer|exists:activity_sectors,id|nullable',
        ];
    }
}
