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
        
        return $this->subject('(WEB TESTING) Congratulation for New Confirmed LUP System ,for: '.$this->lup->nolup.' Rev-'.$this->lup->revision)
                    ->view('emails.lup.notifluphasapproved')                   
                    ->attachFromStorage($this->mailData['path'], 
                        $this->lup->nolup.' Rev-'.$this->lup->revision.'.pdf', [
                        'mime' => 'application/pdf']);
    }
}