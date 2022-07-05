<?php

namespace App\Console\Commands\LUP;

use App\Models\LUP\LUPAction;
use Illuminate\Console\Command;

class NotifOverdueThisMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lup:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lupactions = LUPAction::OverdueThisMonth()->get();
        foreach ($lupactions as $lupaction){
           
        }
        
        return 0;
    }
}
