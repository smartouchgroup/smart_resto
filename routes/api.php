<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\employeesControllers\AccountController;
use App\Http\Controllers\API\employeesControllers\HomeController;
use App\Http\Controllers\API\employeesControllers\ForgotPasswordController;
use App\Http\Controllers\API\employeesControllers\CommandController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::post('/changeData', [AuthController::class, 'changeData']);
    Route::post('/changePassword', [AuthController::class, 'changePassword']);
    Route::post('/changeProfile', [AuthController::class, 'upload']);
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::resource('/account', AccountController::class); //pour voir les details d'un restaurant
    Route::get('/search',[HomeController::class, 'search']);//pour la recherche
    Route::get('/dishes',[HomeController::class, 'index']); // Pour afficher les plats du jour
    Route::post('/buy_ticket',[AccountController::class, 'buy_ticket']); //Achat de tickets
    Route::get('/get_tickets',[AccountController::class, 'get_ticket']); //Obtenir le nombre de ticket du user
    Route::post('/commands',[CommandController::class, 'store']);//faire une commande avec decrementation de ticket
    Route::get('/getCommands',[CommandController::class, 'getCommands']);//obtenir les commandes non validées
    Route::get('/getValidateCommands',[CommandController::class, 'getValidateCommands']);//obtenir les commandes validées
    Route::post('/deposit', [AccountController::class, 'deposit']); //Faire un depot dans son compte
    Route::get('/show_details' ,[AccountController::class ,'show_details' ]); // Pour voir les details du restaurants
    Route::get('/get_amount',[AccountController::class, 'get_amount']); //Obtenir le solde du User
    Route::get('/userInformation' ,[AccountController::class, 'get_userInformation']); //pour recuperer les informations autres informations de l'utilisateurs

    Route::get('/restaurants', [AccountController::class, 'restaurants']);
});

// Route::post('/changeEmail', [AuthController::class, 'changeEmail']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/check_code', [AuthController::class, 'checkCode']);
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);
