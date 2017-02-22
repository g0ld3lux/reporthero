<?php

namespace Reporthero\Mail;

use Reporthero\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome')->with([
                        'orderName' => $this->order->name,
                        'orderPrice' => $this->order->price,
                    ]) ->attach('/path/to/file', [
                        'as' => 'name.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }

    private function getReport()
    {
        // Session / month
        // Unique User / month
        // Ecommerce Conversion Rate / Orders
        // Email Capture Rate / Emails
        // Welcome Place Order Rate / Orders
        // Repeat Rate / Oders
    }
}
