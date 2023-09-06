<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Requisição para resgate de vendas com filtro.
 */
final class SaleFilterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'from' => 'date',
            'to' => 'date',
            'division' => 'integer',
            'unit' => 'integer',
            'seller' => 'integer'
        ];
    }
}
