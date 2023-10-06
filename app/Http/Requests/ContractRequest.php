<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'contract_number' => 'required|unique:contracts,contract_number,' . $this->contract, // Unique rule with an exception for update
            'start_date' => 'required|date',
            'start_date' => 'nullable|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:inhouse,outsource',
            'agreement_file' => 'required|in:inhouse,outsource',
        ];
    }
}
