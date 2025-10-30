<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;


    public $orderCode;

    /**
     * Create a new message instance.
     *
     * @param  string  $orderCode
     * @return void
     */
    public function __construct($orderCode)
    {
        $this->orderCode = $orderCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.OrderConfirmationMai')->subject('Order Confirmation')
            ->with(['orderCode' => $this->orderCode]);
    }
}
