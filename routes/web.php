<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;



// Student Api's
Route::post('/stu/register', [StudentController::class, 'RegisterFunc']);
Route::post('/stu/login', [StudentController::class, 'loginFunc']);
Route::post('/stu/showResult', [StudentController::class, 'showResult']);


// Super Admin Api's 
Route::post('/superadmin/login', [SuperAdminController::class, 'loginFunc']);
Route::post('/superadmin/users-list', [SuperAdminController::class, 'userList']);
Route::post('/superadmin/update-credits', [SuperAdminController::class, 'updateCredit']);


// Admin Api's 
Route::post('/admin/login', [AdminController::class, 'loginFunc']);
Route::post('/admin/users-list', [AdminController::class, 'userList']);
Route::post('/admin/update-credits', [AdminController::class, 'updateCredit']);




// Admin Api's 

Route::get('/', function () {
    return view('home');
});
