<?php

use App\Http\Controllers\employeesControllers\AuthController;
use App\Http\Controllers\employeesControllers\AccountController;
use App\Http\Controllers\employeesControllers\CommandController;
use App\Http\Controllers\employeesControllers\HomeController;
use App\Http\Controllers\employeesControllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

    Route::get('login', [AuthController::class,'index'])->name('login');
    Route::post('login',[AuthController::class, 'login'])->name('employee.login');
    Route::post('logout',[AuthController::class, 'logout'])->name('employee.logout');
    Route::get('identy_code',[AuthController::class,'identify'])->name('identy_code');
    Route::post('check_code', [AuthController::class, 'checkCode'])->name('checkCode');
    // Route::get('/forget_password', [AuthController::class, 'forget_password_index'])->name('forget_password');
    Route::middleware('auth.employee')->group(function () {
        Route::resource('/command', CommandController::class);
        Route::resource('/account', AccountController::class);
        // Route::get('detailsRestaurant',[AccountController::class,'details_index'])->name('details.restaurants');
        Route::get('/wallet', [AccountController::class, 'wallet_index'])->name('account.wallet');
        Route::get('/deposit', [AccountController::class, 'deposit_index'])->name('account.deposit');
        Route::post('/deposit', [AccountController::class, 'deposit'])->name('account.deposit');
        Route::get('/tickets', [AccountController::class, 'tickets_index'])->name('acccount.tickets');
        Route::post('/buy_ticket', [AccountController::class, 'buy_ticket'])->name('acccount.buy_ticket');
        Route::get('/restaurants', [AccountController::class, 'restaurants'])->name('account.restaurants');
        Route::post('/changeEmail', [AuthController::class, 'changeEmail'])->name('account.changeEmail');
        Route::post('/changeData', [AuthController::class, 'changeData'])->name('account.changeData');
        Route::post('/changePassword', [AuthController::class, 'changePassword'])->name('account.changePassword');
        Route::resource('/', HomeController::class);
        Route::post('/changeProfile', [AuthController::class, 'upload'])->name('account.upload');
        //for the research
        Route::get('/search',[HomeController::class, 'search'])->name('search');
        //for the commands
        // Route::post('/commands',[CommandsController::class,'commands'])->name('account.commands');
    });
    //route pour renitialiser le mot de passe
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
