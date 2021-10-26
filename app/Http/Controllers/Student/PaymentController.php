<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\Receipt;
use App\Services\PaymentService;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $payments = auth()->user()->student->payments()->get();

        return view('student.payments.index', compact('payments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\View\View
     */
    public function show(Payment $payment)
    {
        $this->authorize('view-payment', $payment);

        $payment->load('receipt', 'student.user');

        $qrcode = QrCode::size(150)->generate($payment->receipt->checkout_url);

        return view('student.payments.show', compact('payment', 'qrcode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $this->authorize('update-payment', $payment);

        $receipt = (new PaymentService($payment))->getReceipt($request->payment_method);

        if (!$receipt['success']) {
            return redirect()->route('student.payments.index')->with('warning', 'Pembayaran gagal diproses! Silahkan ulangi beberapa saat lagi');
        }

        $payment->update(['status' => 'Diproses']);

        Receipt::create(['payment_id' => $payment->id] + $receipt['data']);

        return redirect()->route('student.payments.index')->with('warning', 'Silahkan melanjutkan proses pembayaran');
    }
}
