<?php

namespace App\Http\Requests\User;

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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:staff,admin,superadmin',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'nik' => 'nullable|string|max:50|unique:users',
            'profile_photo' => 'nullable|image|max:2048',
            'kota_id' => 'nullable|exists:kotas,id',
            'provinsi_id' => 'nullable|exists:provinsis,id',
        ];
    }
}
