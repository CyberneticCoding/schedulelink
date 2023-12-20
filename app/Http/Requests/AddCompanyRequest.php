<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCompanyRequest extends FormRequest
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

			'name' => 'required|unique:companies|min:3',
			'description' => 'max:256',
		];
	}

		public function messages()
	{
		return [
			'firstname.required' => 'The first name field is required.',
			'lastname.required' => 'The last name field is required.',
			'email.email' => 'E-mail address is invalid',
			'password_confirmation.same' => 'Password fields don\'t match'
		];

	}
}
