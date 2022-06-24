<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\File;
use App\Models\RDMS\MasterPart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RDMS\MasterPartController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test', function(){
    $stockin = DB::table('rdms_be.stock_in_data')->where('part','PCB021')->sum('qty_input');
    $stockout = DB::table('rdms_be.stock_out_data')->where('part','PCB021')->sum('qty_out');
    Artisan::queue('listen');
    Return 'Masuk '.$stockin.'<br>Keluar : '.$stockout.'<br> Sisa :'.($stockin - $stockout);
}); 

 /* route group that only auth user can access,  inactive user can access*/
 Route::group(['middleware' => 'auth'], function() {      
    
       
 });

 /* route group that only active user can access*/
 Route::group(['middleware' => 'active'], function() {  

    /* RDMS route */
    Route::get('/masterpart', [MasterPartController::class, 'index']);
    Route::get('/masterpart/query/{id}', [MasterPartController::class, 'query']);
    Route::get('/newpart', [MasterPartController::class, 'create']);
    Route::POST('/masterpart/store', [MasterPartController::class, 'store']);
    Route::get('/masterpart/{id}/edit', [MasterPartController::class, 'edit']);
    Route::put('/masterpart/{id}/updatebasic', [MasterPartController::class, 'updatebasic']);
    Route::post('/masterpart/autofill_old_desc', [MasterPartController::class, 'autofill_old_desc']);
    Route::post('/masterpart/tesupdatehistory', [MasterPartController::class, 'tesupdatehistory']);
});    

/* route group that only active reviewer can access*/
Route::group(['middleware' => 'reviewer'], function() {
        

});

/* route group that only active approver can access*/
Route::group(['middleware' => 'approver'], function() {
    

});