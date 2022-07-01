<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LUP\LUPFileController;
use App\Http\Controllers\LUP\LUPActionController;
use App\Http\Controllers\LUP\LUPParentController;
use App\Http\Controllers\LUP\LUPDashboardController;
use App\Http\Controllers\ICCS\RelatedUtilityController;
use App\Http\Controllers\ICCS\RelatedDocumentController;
use App\Http\Controllers\ICCS\RelatedMaterialController;
use App\Http\Controllers\LUP\RelatedDepartmentController;


 /* route group that only active user can access*/
 Route::group(['middleware' => 'active'], function() {     
        
    /* lup route */
    Route::get('/lup/masterlist', [LUPParentController::class, 'index']);
    Route::get('/lup/new', [LUPParentController::class, 'create']);
    Route::post('/lup/store', [LUPParentController::class, 'store']);
    Route::get('/lup/{id}/edit', [LUPParentController::class, 'edit']);
    Route::put('/lup/{id}/update', [LUPParentController::class, 'update']);
    Route::put('/lup/{id}/updatecategorization', [LUPParentController::class, 'updatecategorization']);
    Route::put('/lup/{id}/updatenotif', [LUPParentController::class, 'updatenotif']);
    Route::put('/lup/{id}/deletenotif', [LUPParentController::class, 'deletenotif']);
    Route::get('/lup/downloadregcheatsheet', [LUPParentController::class, 'downloadregcheatsheet']);
    Route::get('/lup/downloadpanduan', [LUPParentController::class, 'downloadpanduan']);
    Route::put('/lup/{id}/requestcancellup', [LUPParentController::class, 'requestcancellup']);
    
    /* lup related department */ 
    Route::get('/lup/{id}/signinisiator', [LUPParentController::class, 'signinisiator']);  
    Route::get('/lup/{id}/cancelsigninisiator', [LUPParentController::class, 'cancelsigninisiator']);  
    Route::put('/lup/{id}/signleader', [LUPParentController::class, 'signleader']);    
    Route::put('/lup/{id}/updateleader', [LUPParentController::class, 'updateleader']);
    Route::get('/lup/{id}/cancelsignleader', [LUPParentController::class, 'cancelsignleader']);  
    Route::put('/lup/{id}/signregulatoryreviewer', [LUPParentController::class, 'signregulatoryreviewer']);  
    Route::get('/lup/{id}/cancelsignregulatoryreviewer', [LUPParentController::class, 'cancelsignregulatoryreviewer']);  
    Route::put('/lup/{id}/updateregulatoryreviewer', [LUPParentController::class, 'updateregulatoryreviewer']);    
    Route::put('/lup/{id}/signregulatoryapprover', [LUPParentController::class, 'signregulatoryapprover']);  
    Route::get('/lup/{id}/cancelsignregulatoryapprover', [LUPParentController::class, 'cancelsignregulatoryapprover']);  
    Route::put('/lup/{id}/updateregulatoryapprover', [LUPParentController::class, 'updateregulatoryapprover']);  
    Route::put('/lup/{id}/updateexternalparty', [LUPParentController::class, 'updateexternalparty']);  
    Route::POST('/lup/approvals/autofill', [RelatedDepartmentController::class, 'autofillapprovals']);
    Route::POST('/lup/approvals/autofill2', [RelatedDepartmentController::class, 'autofillapprovals2']);
    Route::POST('/lup/{id}/storedepartment', [RelatedDepartmentController::class, 'storedepartment']);
    Route::put('/lup/{id}/signdepartment', [RelatedDepartmentController::class, 'signdepartment']);
    Route::get('/lup/department-impact/{id}/delete', [RelatedDepartmentController::class, 'delete']);
    Route::get('/lup/department-impact/{id}/cancelsign', [RelatedDepartmentController::class, 'cancelsign']);

    Route::put('/lup/{id}/submittoreviewer', [LUPParentController::class, 'submittoreviewer']);        
    Route::get('/lup/{id}/printlup', [LUPParentController::class, 'printlup']);     

    /* lup attachments */    
    Route::POST('/lup/attachment/{id}/upload', [LUPFileController::class, 'upload']);
    Route::POST('/lup/attachment/{id}/update', [LUPFileController::class, 'reupload']);
    Route::get('/lup/attachment/{id}/download', [LUPFileController::class, 'download']);
    Route::get('/lup/attachment/{id}/delete', [LUPFileController::class, 'destroy_attachment']);

    /* lup document impact */    
    Route::POST('/lup/document-impact/{id}/store', [RelatedDocumentController::class, 'store']);
    Route::PUT('/lup/document-impact/{id}/update', [RelatedDocumentController::class, 'update']);      
    Route::get('/lup/document-impact/{id}/delete', [RelatedDocumentController::class, 'delete']);

    /* lup material impact */    
    Route::POST('/lup/material-impact/{id}/store', [RelatedMaterialController::class, 'store']);
    Route::PUT('/lup/material-impact/{id}/update', [RelatedMaterialController::class, 'update']);    
    Route::get('/lup/material-impact/{id}/delete', [RelatedMaterialController::class, 'delete']);

    /* lup utility impact */    
    Route::POST('/lup/utility-impact/{id}/store', [RelatedUtilityController::class, 'store']);
    Route::PUT('/lup/utility-impact/{id}/update', [RelatedUtilityController::class, 'update']);    
    Route::get('/lup/utility-impact/{id}/delete', [RelatedUtilityController::class, 'delete']);


    /* lup Action route */
    Route::get('/lupaction', [LUPActionController::class, 'index']);
    Route::get('/lup/newaction', [LUPActionController::class, 'create']);
    Route::POST('/lup/action/store', [LUPActionController::class, 'store']);    
    Route::put('/lup/action/{id}/update', [LUPActionController::class, 'update']);    
    Route::get('/lup/action/{id}/delete', [LUPActionController::class, 'destroy']);
    Route::get('/lup/action/{id}/sign', [LUPActionController::class, 'sign']);
    Route::get('/lup/action/{id}/cancelsign', [LUPActionController::class, 'cancelsign']);
    Route::POST('/lup/action/{id}/uploadevidence', [LUPActionController::class, 'uploadevidence']);
    Route::get('/lup/action/{id}/downloadevidence', [LUPActionController::class, 'downloadevidence']);
    Route::put('/lup/action/{id}/storeextension', [LUPActionController::class, 'storeextension']);    
    Route::put('/lup/action/{id}/requestcancelaction', [LUPActionController::class, 'requestcancelaction']);    

    /* LUP Dashboard route */
    Route::get('/querylupmyonprocess', [LUPDashboardController::class, 'querylup_myonprocess']);
    Route::get('/querylupmyoncancel', [LUPDashboardController::class, 'querylup_myoncancel']);
    Route::get('/querylupsignaction', [LUPDashboardController::class, 'querylup_signaction']);
    Route::get('/querylupleader', [LUPDashboardController::class, 'querylup_leader']);
    Route::get('/querylupmyactionopen', [LUPDashboardController::class, 'querylup_myactionopen']);
    Route::get('/querylupmyactioncancel', [LUPDashboardController::class, 'querylup_myactioncancel']);
    Route::get('/querylupmyactionoverdue', [LUPDashboardController::class, 'querylup_myactionoverdue']);
    Route::get('/querylupmydeptactionopen', [LUPDashboardController::class, 'querylup_mydeptactionopen']);
    Route::get('/querylupmydeptactionoverdue', [LUPDashboardController::class, 'querylup_mydeptactionoverdue']);
    Route::get('/querylupmyactionextension', [LUPDashboardController::class, 'querylup_myactionextension']);   
    Route::get('/queryluponprocess', [LUPDashboardController::class, 'querylup_onprocess']); 
    Route::get('/queryluponreview', [LUPDashboardController::class, 'querylup_onreview']); 
    Route::get('/queryluponapproval', [LUPDashboardController::class, 'querylup_onapproval']); 
    Route::get('/queryluponapproved', [LUPDashboardController::class, 'querylup_onapproved']); 
    Route::get('/queryluponcancel', [LUPDashboardController::class, 'querylup_oncancel']);
    Route::get('/queryluponclosing', [LUPDashboardController::class, 'querylup_onclosing']);
    Route::get('/queryluponcancelapproval', [LUPDashboardController::class, 'querylup_oncancelapproval']);
    Route::get('/queryluponclosingapproval', [LUPDashboardController::class, 'querylup_onclosingapproval']);
    Route::get('/querylupactionoverdue', [LUPDashboardController::class, 'querylup_actionoverdue']);
    Route::get('/querylupactionextension', [LUPDashboardController::class, 'querylup_actionextension']);
    Route::get('/querylupactionclosing', [LUPDashboardController::class, 'querylup_actionclosing']);
    Route::get('/querylupactioncancel', [LUPDashboardController::class, 'querylup_actioncancel']);
    Route::get('/querylupactionextensionapproval', [LUPDashboardController::class, 'querylup_actionextensionapproval']);
    Route::get('/queryluprelateddepartments', [LUPDashboardController::class, 'querylup_relateddepartments']);
    Route::get('/querylupregulatoryreview', [LUPDashboardController::class, 'querylup_regulatoryreview']);
    Route::get('/querylupregulatoryapproval', [LUPDashboardController::class, 'querylup_regulatoryapproval']);
      
});    

/* route group that only active reviewer can access*/
Route::group(['middleware' => 'reviewer'], function() {
        
    /* lup route */
    Route::put('/lup/{id}/signreviewerqse', [LUPParentController::class, 'signreviewerqse']);  
    Route::get('/lup/{id}/rollbackinisiator', [LUPParentController::class, 'rollbackinisiator']);  
    Route::get('/lup/{id}/cancellup', [LUPParentController::class, 'cancellup']);  
    Route::get('/lup/{id}/reactivation', [LUPParentController::class, 'reactivation']); 
    Route::put('/lup/{id}/updateapprover', [LUPParentController::class, 'updateapprover']); 
    Route::put('/lup/action/{id}/approvedevidence', [lupActionController::class, 'approvedevidence']);
    Route::put('/lup/action/{id}/rejectevidence', [lupActionController::class, 'rejectevidence']);
    Route::put('/lup/action/{id}/reviewextension', [LUPActionController::class, 'reviewextension']);    
    Route::put('/lup/action/{id}/approvedcancelaction', [lupActionController::class, 'approvedcancelaction']);
    Route::put('/lup/{id}/reviewcancellup', [LUPParentController::class, 'reviewcancellup']);   
    Route::put('/lup/{id}/requestclosinglup', [LUPParentController::class, 'requestclosinglup']);   

});

/* route group that only active approver can access*/
Route::group(['middleware' => 'approver'], function() {
    Route::put('/lup/{id}/approvedlup', [lupParentController::class, 'approvedlup']); 
    Route::put('/lup/{id}/confirmedlup', [lupParentController::class, 'confirmedlup']); 
    Route::put('/lup/{id}/signreviewerqcjm', [LUPParentController::class, 'signreviewerqcjm']);  
    Route::put('/lup/action/{id}/approvedextension', [LUPActionController::class, 'approvedextension']); 
    Route::put('/lup/action/{id}/rejectextension', [lupActionController::class, 'rejectextension']);
    Route::put('/lup/{id}/approvedcancellup', [LUPParentController::class, 'approvedcancellup']);
    Route::put('/lup/{id}/closinglup', [LUPParentController::class, 'closinglup']);  
    Route::put('/lup/{id}/rollback', [LUPParentController::class, 'rollback']);  
});