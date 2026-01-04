<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'staff_id' => 'required|exists:users,id',
            'nama_customer' => 'required|string|max:255',
            'pusat_id' => 'required|exists:pusats,id',
            'status' => 'required|string|in:pending,completed,cancelled',
            'nomor_meja' => 'nullable|string|max:50',
            'total_waktu' => 'nullable|numeric|min:0',
            'harga_per_jam' => 'nullable|numeric|min:0',
            'total_harga' => 'nullable|numeric|min:0',
            'waktu_tutup' => 'nullable|date_format:Y-m-d H:i:s',
            'details' => 'nullable|array|min:1',
            'details.*.nama_fnb' => 'nullable|string|max:255',
            'details.*.harga' => 'nullable|numeric|min:0',
            'details.*.quantity' => 'nullable|numeric|min:0',
        ];
    }
}
