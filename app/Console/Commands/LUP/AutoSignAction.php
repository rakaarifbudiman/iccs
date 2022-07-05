<?php

namespace App\Console\Commands\LUP;

use App\Models\LUP\LUPAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutoSignAction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lup:sign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Sign LUP action if created date more than 3 days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {        
        $lupactions = LUPAction::where('created_at','<',now()->adddays(-3))
                    ->where('actionstatus',null)
                    ->where('signdate_action',null)
                    ->where('duedate_action','<>',null)->get();       
        foreach($lupactions as $lupaction){
            $lupaction->signdate_action = now(); 
            $lupaction->sign_type = "System";                 
            $lupaction->save();
        }        
       
    }
}
