<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/test', function () {
        return 'السلام عليكم';
    });
Route::get('verify-email/{guard}',function(){
return 'r';

})->name('verification.verify')->where('guard','web|freelancer');

// -------------------- Admin Routes --------------------
Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'indexLogin')->name('login')->defaults('guard', 'admin');
        Route::post('login', 'login')->name('login.submit')->defaults('guard', 'admin');
         Route::get('dashboard','dashboard')->name('dashboard');
});
    });




// -------------------- Web Routes --------------------
Route::controller(AuthController::class)->group(function () {

    Route::get('login', 'indexLogin')->name('web.login')->defaults('guard', 'web');
    Route::post('login', 'login')->name('web.login.submit')->defaults('guard', 'web');

    Route::get('register', 'indexRegister')->name('web.register')->defaults('guard', 'web');
    Route::post('register', 'register')->name('web.register.submit')->defaults('guard', 'web');

    Route::get('dashboard', function () {
        return view('web.dashboard');
    })->name('dashboard');
});

// -------------------- Freelancer Routes --------------------
Route::prefix('freelancer')->name('freelancer.')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'indexLogin')->name('login')->defaults('guard', 'freelancer');
        Route::post('login', 'login')->name('login.submit')->defaults('guard', 'freelancer');

        Route::get('register', 'indexRegister')->name('register')->defaults('guard', 'freelancer');
        Route::post('register', 'register')->name('register.submit')->defaults('guard', 'freelancer');
        Route::get('dashboard','dashboard')->name('dashboard');
    });

   
});
