<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\InterestTransaction;

class SystemBonus extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $interest_transaction;

    public function __construct(InterestTransaction $interest_transaction)
    {
        $this->interest_transaction = $interest_transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('account@wallet.com')
                ->view('emails.system_bonus');
    }
}
