<?php

namespace App\Http\Requests\Profiles;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiProfileUpdateRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'first_name' => ['nullable', 'string', 'min:4', 'max:255'],
			'last_name ' => ['nullable', 'string', 'min:4', 'max:255'],
			'email' => [
				'nullable',
				'string',
				'lowercase',
				'email',
				'max:255',
				Rule::unique(User::class)->ignore($this->user()->id),
			],
			'current_password' => ['nullable', 'string', 'min:8'],
			'phone' => ['nullable', 'string', 'min:1'],

			'avatar' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10485',
			'remove_avatar' => ['nullable','boolean'],
		];
	}
}
