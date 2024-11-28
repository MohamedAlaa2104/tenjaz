<?php

namespace App\Http\Requests\Api\V1\User;

use App\Traits\HasApiFailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    use HasApiFailedValidation;

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
            'name' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|max:255|unique:users,username,' . $this->route('user'),
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $this->route('user'),
            'password' => 'nullable|string|min:6',
            'avatar' => 'nullable|string', // Ensure avatar is an image
            'subscription_type_id' => 'sometimes|integer|exists:subscription_types,id',
            'is_active' => 'sometimes|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('password')) {
            $this->merge([
                'password' => bcrypt($this->password)
            ]);
        }
    }
}
