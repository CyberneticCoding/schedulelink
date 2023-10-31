<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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

			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|unique:users|email',
			'password' => 'required|min:7',
			'password_confirmation' => 'required|same:password',
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
