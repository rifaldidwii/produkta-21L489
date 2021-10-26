<?php

namespace App\Http\Requests;

use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSubjectRequest extends FormRequest
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
            'teacher_id' => ['required', 'exists:teachers,id'],
            'name' => ['required', 'array'],
            'name.*' => ['string', Rule::in(Subject::NAME)],
            'grade' => ['required', 'array'],
            'grade.*' => ['string', Rule::in(Subject::GRADE)],
        ];
    }
}
