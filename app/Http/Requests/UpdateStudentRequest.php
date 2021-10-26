<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            'birthplace' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date_format:Y-m-d'],
            'phone' => ['required', 'string', 'min:5', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'school' => ['required', 'string', 'max:255'],
            'grade' => ['required', 'string', Rule::in(Student::GRADE)],
            'classrooms' => ['required', 'array'],
            'classrooms.*' => ['integer', 'exists:classrooms,id']
        ];
    }
}
