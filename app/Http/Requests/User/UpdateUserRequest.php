<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],

            'password' => 'nullable|string|min:8|confirmed',

            'role' => [
                'required',
                'string',
                Rule::in(['staff', 'admin', 'superadmin']),
            ],

            'dob' => 'nullable|date',

            'gender' => [
                'nullable',
                'string',
                Rule::in(['male', 'female']),
            ],

            'phone' => 'nullable|string|max:20',

            'address' => 'nullable|string|max:500',

            'nik' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('users', 'nik')->ignore($userId),
            ],

            'profile_photo' => 'nullable|image|max:2048',

            'kota_id' => 'nullable|exists:kotas,id',

            'provinsi_id' => 'nullable|exists:provinsis,id',
        ];
    }
}
