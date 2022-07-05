<?php

namespace App\Console\Commands\ICCS;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteLoginToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login-token:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear login token';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expired = Carbon::now()->addMinutes(-5)->timestamp;         
        $tokens = DB::table('mfalogins')->get(); 
        
        foreach ($tokens as $token){
           $cektime = (strtotime(\Carbon\Carbon::now()) - strtotime($token->created_at))/60 ;                      
            if ($cektime < 5){
            }else{
                $deltoken = DB::table('mfalogins')->where('token',$token->token)->delete();                
            } 
        }        
        return 0;
    }
}
