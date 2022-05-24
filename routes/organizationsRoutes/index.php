<?php


use App\Http\Controllers\organizationsControllers\AuthController;
use App\Http\Controllers\organizationsControllers\backgroundController;
use App\Http\Controllers\organizationsControllers\ticketsController;
use App\Http\Controllers\organizationsControllers\GroupController;
use App\Http\Controllers\organizationsControllers\RestaurantController;
use App\Http\Controllers\organizationsControllers\EmployeeController;
use App\Http\Controllers\organizationsControllers\settingsController;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;

Route::prefix('org')->group(function () {
    Route::get('login', [AuthController::class,'index'])->name('org.login');
    Route::post('login', [AuthController::class,'login'])->name('org.login');
    Route::middleware('auth.org')->group(function () {
        Route::get('/', [AuthController::class, 'home'])->name('org.home');
        Route::post('/logout',[AuthController::class, 'logout'])->name('org.logout');
        Route::resource('tickets',ticketsController::class);
        Route::resource('groups', GroupController::class);
        Route::resource('add_employees', EmployeeController::class);
        Route::resource('org_restaurants', RestaurantController::class);

        Route::post('changeStatus', [EmployeeController::class, 'changeStatus'])->name('role.changeStatus');
        Route::get('profileOrganization',[settingsController::class,'organizationProfile'])->name('organization.profile');
        Route::post('changeOrganizationName',[settingsController::class,'changeOrganizationName'])->name('organizationName');
        Route::post('changeOrganizationPhone',[settingsController::class,'changeOrganizationPhone'])->name('organizationPhone');
        Route::post('changeOrganizationEmail',[settingsController::class,'changeOrganizationEmail'])->name('organizationEmail');
        Route::post('changeOrganizationProfile',[settingsController::class,'upload'])->name('organizationProfile');
    });
    route::resource('background',backgroundController::class);
    // Route::get('password_forgot',[AuthController::class,'password_forgot'])->name('password_forgot');
    // Route::post('sendLink',[AuthController::class,'sendLink']);
    // Route::get('reset_password/{token}', [AuthController::class, 'reset_password'])->name('reset_password');
    // Route::post('submitResetPasswordForm', [AuthController::class, 'submitResetPasswordForm']);


Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password');
});
