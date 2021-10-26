<?php

namespace App\Observers;

use App\Jobs\SendWhatsappMessage;
use App\Models\Payment;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        Notification::send($payment->student->user, new PaymentNotification(($payment)));
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        if ($payment->status == 'Lunas') {
            $phone = "{$payment->student->phone}";
            $text = "{$payment->description} sebesar {$payment->formatted_amount} oleh {$payment->student->name} telah diselesaikan dengan status {$payment->status}";

            SendWhatsappMessage::dispatchSync($phone, $text);
        }
    }
}
