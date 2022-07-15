<?php

namespace App\Http\Controllers\ICCS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EmailLogController extends Controller
{
    public function index()
    {
        $emaillogs = DB::table('email_log')->get();
        return view('iccs.listnotification',[
            'emaillogs'=>$emaillogs,
        ]);
    }

    public function show(Request $request)
    {
        
    }

    public function readnotification(Request $request)
    {
        
    }
}
