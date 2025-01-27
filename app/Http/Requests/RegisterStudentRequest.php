<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required|min:6',
            'age' => 'required|integer',
            'gender' => 'required',
            'course' => 'required',
            'image' => 'required|mimes:png,jpg'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Sorry, your name please',
            'password.min' => 'Sorry, your password must be more than 6 characters.',
            'age.integer' => 'Age must be a number.',
            'image.mimes' => 'Sorry only png and jpg images are supported'
        ];
    }

}
