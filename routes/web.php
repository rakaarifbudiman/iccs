<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ICCS\GradeController;
use App\Http\Controllers\ICCS\EmailLogController;
use App\Http\Controllers\ICCS\DashboardController;
use App\Http\Controllers\ICCS\DepartmentController;
use App\Http\Controllers\ICCS\MailSettingController;



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
require __DIR__.'/auth.php';
require __DIR__.'/flp.php';
require __DIR__.'/lup.php';
require __DIR__.'/rdms.php';
Route::view('/test1',view: 'welcome');
require __DIR__.'/admin_web.php';


Route::get('/test1', function () {
    return redirect()->route('index');
})->name('/test1');

Route::view('sample-page', 'admin.pages.sample-page')->name('sample-page');

Route::prefix('dashboard')->group(function () {
    Route::view('/test1', 'admin.dashboard.default')->name('index');
    Route::view('default', 'admin.dashboard.default')->name('dashboard.index');
});

Route::view('default-layout', 'multiple.default-layout')->name('default-layout');
Route::view('compact-layout', 'multiple.compact-layout')->name('compact-layout');
Route::view('modern-layout', 'multiple.modern-layout')->name('modern-layout');


 /* route group that only auth user can access,  inactive user can access*/
 Route::group(['middleware' => 'auth'], function() {         
    Route::get('/', [DashboardController::class, 'index']); 
    Route::get('/dashboard', [DashboardController::class, 'index']); 
    Route::get('/users-profile/{id}/edit/{tab}', [UserController::class, 'editpassword']);    
    Route::put('/users-profile/{id}/changepassword', [UserController::class, 'changepassword']);   
    Route::get('/listnotification', [EmailLogController::class, 'index']); 
    Route::POST('/readnotification', [EmailLogController::class, 'readnotification']);         
 });

 
 /* route group that only active user can access*/
 Route::group(['middleware' => 'active'], function() {  
    Route::view('/phpversion', view: 'phpversion');   
    Route::POST('/tcodeiccs', [DashboardController::class, 'tcode']);    
    Route::get('/users-profile/{id}/edit', [UserController::class, 'edit']);    
    Route::put('/users-profile/update/{id}', [UserController::class, 'update']);   
});    

/* route group that only active reviewer can access*/
Route::group(['middleware' => 'reviewer'], function() {
        
    /* user route */           
    Route::get('/listusers', [UserController::class, 'index']);        
    Route::put('/users-profile/activate/{id}', [UserController::class, 'activate']);
    Route::put('/users-profile/deactivate/{id}', [UserController::class, 'deactivate']);
    Route::get('/users-profile/delete/{id}', [UserController::class, 'destroy']);                
    /* Department route */
    Route::get('/department', [DepartmentController::class, 'index']);
    Route::get('/department/{id}/edit', [DepartmentController::class, 'edit']);
    Route::put('/department/{id}/update', [DepartmentController::class, 'update']);
    Route::get('/department/delete/{id}', [DepartmentController::class, 'destroy']);
    /* grade route */
    Route::get('/grade', [GradeController::class, 'index']);
    Route::get('/grade/{id}/edit', [GradeController::class, 'edit']);
    Route::put('/grade/{id}/update', [GradeController::class, 'update']);
    Route::get('/grade/delete/{id}', [GradeController::class, 'destroy']);    
});

/* route group that only active approver can access*/
Route::group(['middleware' => ['approver']], function() {
    Route::get('/mail/setting/edit', [MailSettingController::class, 'edit']);
    Route::put('/mail/setting/update', [MailSettingController::class, 'update']);
});