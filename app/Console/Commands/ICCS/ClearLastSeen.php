<?php

namespace App\Console\Commands\ICCS;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class ClearLastSeen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:lastseen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Last Seen of Online User';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users= USER::where('last_seen','<>',null)->get();

        foreach ($users as $user){
            $cektime = (strtotime(\Carbon\Carbon::now()) - strtotime($user->last_seen))/60 ;                      
             if ($cektime > 5){  
                 $user->last_seen = null;
                 $user->save();                            
             }              
         }               
        $this->info('Last Seen has been cleared succesfully');     
    }
}
