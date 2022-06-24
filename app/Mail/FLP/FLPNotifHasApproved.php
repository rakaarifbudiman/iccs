<?php

namespace App\Mail\FLP;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\FLP\FLPParent;
use Mail;

class FLPNotifHasApproved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailData;
    public $flp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, FLPParent $flp)
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
        
        return $this->subject('(WEB TESTING) Congratulation for New Approved FLP System ,for: '.$this->flp->noflp.' Rev-'.$this->flp->revision)
                    ->view('emails.flp.notifhasapproved')                   
                    ->attachFromStorage($this->mailData['path'], 
                        $this->flp->noflp.' Rev-'.$this->flp->revision.'.pdf', [
                        'mime' => 'application/pdf']);
    }
}