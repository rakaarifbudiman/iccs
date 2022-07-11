<?php

namespace App\Mail\LUP;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LUP\LUPParent;
use App\Models\LUP\LUPAction;

class LUPActionNotif extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailData;    
    public $lupactions;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData,$lupactions)
    {
        $this->mailData = $mailData;        
        $this->lupactions = $lupactions;   
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $lupactions = $this->lupactions;
        return $this->subject('(WEB TESTING) Notification for Confirmed Due Date Action : '.$this->mailData['nolup'])
                    ->view('emails.lup.notifconfirmedaction');
    }
}

