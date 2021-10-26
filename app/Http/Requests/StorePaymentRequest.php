<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'student_id' => ['nullable', 'exists:students,id'],
            'grade' => ['nullable', Rule::in(Student::GRADE)],
            'amount' => ['required', 'integer'],
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Lunas,Belum Dibayar']
        ];
    }
}
