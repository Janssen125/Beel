<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionDetailRequest extends FormRequest
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
            'transaction_header_id' => 'required|exists:transaction_headers,id',
            'nama_fnb' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
