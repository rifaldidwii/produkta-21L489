<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PaymentService
{
    private $payment;

    private $paymentMethod;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Send HTTP request to tripay payment gateway and get transaction receipt
     *
     * @param  string  $paymentMethod
     * @return \Illuminate\Support\Collection
     */
    public function getReceipt(string $paymentMethod): Collection
    {
        $apiKey = config('services.tripay.api_key');
        $privateKey = config('services.tripay.private_key');
        $merchantCode = config('services.tripay.merchant_code');
        $merchantRef = 'LKP_AR_RISALAH' . time();
        $amount = $this->payment->amount;
        $this->paymentMethod = $paymentMethod;

        $data = [
            'method'            => $this->paymentMethod,
            'merchant_ref'      => $merchantRef,
            'amount'            => $amount,
            'customer_name'     => auth()->user()->student->name,
            'customer_email'    => auth()->user()->email,
            'customer_phone'    => preg_replace('/[\s\D]+/', '', auth()->user()->student->phone),
            'order_items'       => [
                [
                    'sku'       => 'LKP_AR_RISALAH',
                    'name'      => $this->payment->description,
                    'price'     => $amount,
                    'quantity'  => 1
                ]
            ],
            'callback_url'      => env('APP_URL') . 'api/callback',
            'return_url'        => env('APP_URL') . 'student/payments',
            'expired_time'      => (time() + (24 * 60 * 60)), // 24 jam
            'signature'         => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $response = Http::withToken($apiKey)->asForm()
            ->post('https://tripay.co.id/api-sandbox/transaction/create', $data);

        return $response->collect();
    }
}
