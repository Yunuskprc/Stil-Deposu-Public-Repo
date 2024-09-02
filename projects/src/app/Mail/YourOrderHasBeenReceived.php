<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class YourOrderHasBeenReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $products;
    public $adress;
    public $cart;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products,$adress,$cart,$user)
    {
        $this->products = $products;
        $this->adress = $adress;
        $this->cart = $cart;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('koprucu2323@hotmail.com')
                    ->subject('Siparişiniz Alındı')
                    ->view('emails.orderHasBeenReceived')
                    ->with([
                        'products' => $this->products,
                        'adress' => $this->adress,
                        'cart' => $this->cart,
                        'user' => $this->user
                    ]);
    }
}