<?php


namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Pago Exitoso')
                    ->view('emails.payment_success')
                    ->with(['payment' => $this->payment]);
    }
}
