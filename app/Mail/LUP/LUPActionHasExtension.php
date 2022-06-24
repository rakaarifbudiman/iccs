<?php

namespace App\Mail\LUP;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LUP\LUPParent;
use App\Models\LUP\LUPAction;

class LUPActionHasExtension extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailData;    
    public $lupactions;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;        
        
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('(WEB TESTING) Notification for Extension Due Date Action : '.$this->mailData['action'].' ('.$this->mailData['nolup'].')')
                    ->view('emails.lup.notifextension');
    }
}

