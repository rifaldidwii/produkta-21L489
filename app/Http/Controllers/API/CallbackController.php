<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    private $privateKey = 'DH3ZA-avXT8-eKRGi-Ve9H8-HuDnG';

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // ambil callback signature
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE') ?? '';

        // ambil data JSON
        $json = $request->getContent();

        // generate signature untuk dicocokkan dengan X-Callback-Signature
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        // validasi signature
        if ($callbackSignature !== $signature) {
            return "Invalid Signature"; // signature tidak valid, hentikan proses
        }

        $data = json_decode($json);
        $event = $request->server('HTTP_X_CALLBACK_EVENT');

        if ($event == 'payment_status') {
            if ($data->status == 'PAID') {
                $merchantRef = $data->merchant_ref;

                // pembayaran sukses, lanjutkan proses sesuai sistem Anda, contoh:
                $receipt = Receipt::where('merchant_ref', $merchantRef)->first();

                if (!$receipt) {
                    return "Receipt not found";
                }

                $receipt->update([
                    'paid_time'    => time(),
                    'status'    => 'PAID'
                ]);

                $receipt->payment->update([
                    'status'    => 'Lunas'
                ]);

                return response()->json([
                    'success' => true
                ]);
            }
        }

        return "No action was taken";
    }
}
