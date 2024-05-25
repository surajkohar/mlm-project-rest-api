<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\DashboardController; 

Route::post('/register',[UserController::class,'register'])->name('register');
Route::post('/login',[UserController::class,'login'])->name('login');

Route::get('/login',function(){
    return view('login');
})->name('signIn');

Route::get('/signup', function() {
    return view('register');
})->name('signUp');

Route::get('/dashboard1',function(){
    // return view('dashboard');
    return 'test';
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function(){

 Route::post('/logout',[UserController::class,'logout'])->name('logout');
 Route::get('/loginuser',[UserController::class,'loggedUser']);
 Route::post('/changePassword',[UserController::class,'chnagePassword']);

//  Route::get('/dashboard',function(){
//     return view('dashboard');
// })->name('dashboard');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});