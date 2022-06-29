<?php

namespace App\Mail\LUP;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LUP\LUPParent;

class LUPHasCancel extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailData;
    public $lup;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, LUPParent $lup)
    {
        $this->mailData = $mailData;
        $this->lup = $lup;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('(WEB TESTING) Notification for Success Cancellation LUP, Code : '.$this->lup->code.' ('.$this->lup->nolup.')')
                    ->view('emails.lup.notifhascancellup');
    }
}

