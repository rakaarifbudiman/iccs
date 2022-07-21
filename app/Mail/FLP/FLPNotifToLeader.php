<?php

namespace App\Mail\FLP;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LUP\LUPParent;

class FLPNotifToLeader extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailData;
    public $flp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, LUPParent $flp)
    {
        $this->mailData = $mailData;
        $this->flp = $flp;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('(WEB TESTING) Notification FLP for Review Leader, Code : '.$this->flp->code)
                    ->view('emails.flp.notiftoleader');
    }
}

