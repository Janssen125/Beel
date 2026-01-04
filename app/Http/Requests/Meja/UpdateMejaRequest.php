<?php

namespace App\Http\Requests\Meja;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMejaRequest extends FormRequest
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
            'pusat_id' => 'required|exists:pusats,id',
            'jenis_meja_id' => 'required|exists:jenis_mejas,id',
            'nomor_meja' => 'required|string|max:10',
            'harga_per_jam' => 'required|numeric|min:0',
            'status' => 'required|string|in:kosong,diambil,rusak,tidak_tersedia',
        ];
    }
}
