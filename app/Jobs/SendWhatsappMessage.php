<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWhatsappMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The phone number and text message data.
     *
     * @var string
     */
    protected string $phone, $text;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $phone, string $text)
    {
        $this->phone = $phone;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Http::asForm()->post('https://whatsapp-api-lkp-ar-risalah.herokuapp.com/send-message', [
            'token' => '7697ef28-8e3a-4363-a576-d25c31f4ed15',
            'phone' => $this->phone,
            'text' => $this->text
        ]);
    }
}
