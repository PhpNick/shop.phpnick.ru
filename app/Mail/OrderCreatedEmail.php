<?php

namespace App\Mail;

use App\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Cart
     */
    public $cart;
    public $order_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cart $cart, $order_id) {
        $this->cart = $cart;
        $this->order_id = $order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orderCreatedEmail')
                    ->subject('Новый заказ на сайте '.env("APP_NAME", "E-Shopper"));
    }
}
