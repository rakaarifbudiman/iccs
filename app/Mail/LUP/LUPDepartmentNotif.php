<?php

namespace App\Mail\LUP;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LUP\LUPParent;

class LUPDepartmentNotif extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mailData;    
    public $lup;
    public $relateddepartments;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData,$lup,$relateddepartments)
    {
        $this->mailData = $mailData;        
        $this->lup = $lup; 
        $this->relateddepartments= $relateddepartments;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $lup = $this->lup;
        return $this->subject('(WEB TESTING) Notification for Reminder Review LUP : '.$this->lup->code)
                    ->view('emails.lup.notifdepartment');
    }
}
