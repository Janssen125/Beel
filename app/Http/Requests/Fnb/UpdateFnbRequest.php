<?php

namespace App\Http\Requests\Fnb;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFnbRequest extends FormRequest
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
            'nama_fnb' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto_fnb' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
