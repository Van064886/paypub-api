<?php

namespace App\Core\Advertisements\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAdvertisementRequest extends FormRequest
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
            "description" => "string|required",
            "enterprise_id" => "integer|exists:enterprises,id|required",
            "action_type" => "integer|exists:call_to_actions,id|required",
            "action_content" => "string|required",
            "start_date" => "date|nullable|after:".now(),
            "end_date" => "date|after:start_date|nullable",
            "total_amount" => "numeric|min:1|required",
            "total_clics" => "numeric|min:1|required",
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4000'
        ];
    }
}
