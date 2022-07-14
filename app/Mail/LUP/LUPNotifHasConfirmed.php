<?php

namespace App\Mail\LUP;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LUP\LUPParent;
use Mail;

class LUPNotifHasConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailData;
    public $lup;
    public $lupactions;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, LUPParent $lup,$lupactions)
    {
        $this->mailData = $mailData;
        $this->lup = $lup;   
        $this->lupactions = $lupactions;      
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $lupactions= $this->lupactions;
        return $this->subject('(WEB TESTING) Congratulation for New Confirmed LUP System ,for: '.$this->lup->nolup.' Rev-'.$this->lup->revision)
                    ->view('emails.lup.notifluphasconfirmed')                   
                    ->attachFromStorage($this->mailData['path'], 
                        $this->lup->nolup.' Rev-'.$this->lup->revision.'.pdf', [
                        'mime' => 'application/pdf']);
    }
}