<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $payment = Payment::with('student')->select('payments.*')->latest();

            return DataTables::of($payment)
                ->addIndexColumn()
                ->editColumn('amount', 'Rp. {{ number_format($amount) }}')
                ->addColumn('action', function ($payment) {
                    return view('datatables.action', compact('payment'));
                })
                ->toJson();
        }

        return view('admin.payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $grades = Student::GRADE;

        $students = Student::all();

        return view('admin.payments.create', compact('grades', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePaymentRequest $request)
    {
        if ($request->student_id) {
            Payment::create($request->validated());
        }

        if ($request->grade) {
            $students = Student::where('grade', $request->grade)->get();

            foreach ($students as $student) {
                $student->payments()->create($request->validated());
            }
        }

        return redirect()->route('admin.payments.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\View\View
     */
    public function show(Payment $payment)
    {
        $payment->load('receipt', 'student.user');

        $qrcode = '';
        if ($payment->receipt) {
            $qrcode = QrCode::size(150)->generate($payment->receipt->checkout_url);
        }

        return view('admin.payments.show', compact('payment', 'qrcode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\View\View
     */
    public function edit(Payment $payment)
    {
        $payment->load('student');

        $students = Student::all();

        return view('admin.payments.edit', compact('payment', 'students'));
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
        $payment->update($request->validated());

        return redirect()->route('admin.payments.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Payment $payment)
    {
        if ($payment->status == 'Lunas') {
            return redirect()->route('admin.payments.index')->with('danger', 'Data gagal dihapus, siswa sudah membayar lunas');
        }

        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Data berhasil dihapus, <a class="text-white" href="' . route('admin.payments.restore', $payment->id) . '">Kembalikan</a>');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $payment_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $payment_id)
    {
        $payment = Payment::onlyTrashed()->findOrFail($payment_id);

        $payment->restore();

        return redirect()->route('admin.payments.index')->with('success', 'Data berhasil dikembalikan');
    }
}
