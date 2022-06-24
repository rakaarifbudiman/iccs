<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\FLP\FLPParent;
use App\Mail\FLP\FLPNotifHasApproved;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $mailData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailData, FLPParent $flp)
    {
        $this->mailData = $mailData;
        $this->flp = $flp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new FLPNotifHasApproved($this->mailData,$this->flp);
        @dd($this->mailData);
        Mail::to(env('MAIL_TO_TESTING'))->send($email);
    }
}
