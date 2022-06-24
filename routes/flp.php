<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FLP\FLPActionController;
use App\Http\Controllers\FLP\FLPParentController;
use App\Http\Controllers\FLP\FLPDashboardController;


 /* route group that only active user can access*/
 Route::group(['middleware' => 'active'], function() {     
        
    /* FLP route */
    Route::get('/flp', [FLPParentController::class, 'index']);
    Route::get('/newflp', [FLPParentController::class, 'create']);
    Route::put('/postflp', [FLPParentController::class, 'store']);
    Route::get('/flp/{id}/edit', [FLPParentController::class, 'edit']);
    Route::put('/flp/{id}/update', [FLPParentController::class, 'update']);    
    Route::POST('uploadattflp/{id}', [FLPParentController::class, 'upload']);
    Route::POST('uploadattflp/{id}/update', [FLPParentController::class, 'reupload']);
    Route::get('downloadattflp/{id}', [FLPParentController::class, 'download']);
    Route::get('/flpfiles/delete/{id}', [FLPParentController::class, 'destroy_attachment']);
    Route::get('/flp/{id}/signinisiator', [FLPParentController::class, 'signinisiator']);  
    Route::get('/flp/{id}/cancelsigninisiator', [FLPParentController::class, 'cancelsigninisiator']);  
    Route::get('/flp/{id}/signleader', [FLPParentController::class, 'signleader']);  
    Route::put('/flp/{id}/updateleader', [FLPParentController::class, 'updateleader']);
    Route::get('/flp/{id}/cancelsignleader', [FLPParentController::class, 'cancelsignleader']);  
    Route::put('/flp/{id}/submittoreviewer', [FLPParentController::class, 'submittoreviewer']);  
    Route::get('/flp/{id}/printflp', [FLPParentController::class, 'printflp']);     

    /* FLP Action route */
    Route::get('/flpaction', [FLPActionController::class, 'index']);
    Route::get('/newflpaction', [FLPActionController::class, 'create']);
    Route::put('/flpaction/store', [FLPActionController::class, 'store']);
    Route::get('/flpaction/{id}/edit', [FLPActionController::class, 'edit']);
    Route::put('/flpaction/{id}/update', [FLPActionController::class, 'update']);
    Route::get('/flpaction/delete/{id}', [FLPActionController::class, 'destroy']);
    Route::get('/flpaction/{id}/sign', [FLPActionController::class, 'sign']);
    Route::get('/flpaction/{id}/cancelsign', [FLPActionController::class, 'cancelsign']);
    Route::POST('/flpaction/{id}/uploadevidence', [FLPActionController::class, 'uploadevidence']);
    Route::get('/flpaction/{id}/downloadevidence', [FLPActionController::class, 'downloadevidence']);

    /* FLP Dashboard route */
    Route::get('/queryflponprocess', [FLPDashboardController::class, 'queryflp_onprocess']);
    Route::get('/queryflpsignaction', [FLPDashboardController::class, 'queryflp_signaction']);
    Route::get('/queryflpleader', [FLPDashboardController::class, 'queryflp_leader']);
    Route::get('/queryflpactionopen', [FLPDashboardController::class, 'queryflp_actionopen']);
    Route::get('/queryflpactionoverdue', [FLPDashboardController::class, 'queryflp_actionoverdue']);
    Route::get('/queryflpactionextension', [FLPDashboardController::class, 'queryflp_actionextension']);    
});    

/* route group that only active reviewer can access*/
Route::group(['middleware' => 'reviewer'], function() {
        
    /* FLP route */
    Route::get('/flp/{id}/signreviewer', [FLPParentController::class, 'signreviewer']);  
    Route::get('/flp/{id}/rollbackinisiator', [FLPParentController::class, 'rollbackinisiator']);  
    Route::get('/flp/{id}/cancelflp', [FLPParentController::class, 'cancelflp']);  
    Route::get('/flp/{id}/reactivation', [FLPParentController::class, 'reactivation']); 
    Route::put('/flp/{id}/updateapprover', [FLPParentController::class, 'updateapprover']); 
    Route::get('/flpaction/{id}/approvedevidence', [FLPActionController::class, 'approvedevidence']);

});

/* route group that only active approver can access*/
Route::group(['middleware' => 'approver'], function() {
    Route::put('/flp/{id}/approvedflp', [FLPParentController::class, 'approvedflp']); 
});