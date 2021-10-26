<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin() || auth()->user()->isstudent();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (auth()->user()->isAdmin()) {
            return [
                'student_id' => ['required', 'exists:students,id'],
                'amount' => ['required', 'integer'],
                'description' => ['required', 'string', 'max:255'],
                'status' => ['required', 'in:Lunas,Belum Dibayar']
            ];
        }

        if (auth()->user()->isStudent()) {
            return [
                'payment_method' => ['required', Rule::in(Payment::METHOD)]
            ];
        }
    }
}
