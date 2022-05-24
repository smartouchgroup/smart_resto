<?php
namespace App\Http\Controllers\adminControllers;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::get('/', [AuthController::class, 'home'])->name('admin.home');
    Route::resource('login', AuthController::class);
    Route::get('login', [AuthController::class, 'index'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');
    Route::middleware('auth.admin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/', [AuthController::class, 'home'])->name('admin.home');
        Route::resource('org_employees', EmployeeController::class);
        Route::resource('restaurants', RestaurantController::class);
        Route::resource('organization', OrganizationController::class);
        Route::resource('org_groups', GroupeController::class);
        Route::resource('role', RoleController::class);
        Route::resource('adminTickets',adminTicketsController::class);
        //Route
        Route::post('role/changeStatus', [RoleController::class, 'changeStatus'])->name('role.changeStatus');
        Route::post('restaurant/changeStatus', [RestaurantController::class, 'changeStatus'])->name('restaurant.changeStatus');
        Route::post('organization/changeStatus', [OrganizationController::class, 'changeStatus'])->name('organization.changeStatus');
        Route::post('employee/changeStatus', [EmployeeController::class, 'changeStatus'])->name('employee.changeStatus');

        Route::post('/restaurant/updateCategory', [RestaurantController::class, 'updateCategory'])->name('restaurant.editCategory');
        Route::get('/restaurant/deleteCategory/{id}', [RestaurantController::class, 'deleteCategory'])->name('restaurant.deleteCategory');
        Route::get('/restaurant/showDish/{id}', [RestaurantController::class, 'showDish'])->name('restaurant.showDish');
        Route::post('/restaurant/updateDish', [RestaurantController::class, 'updateDish'])->name('restaurant.updateDish');
        Route::get('/restaurant/deleteDish/{id}', [RestaurantController::class, 'deleteDish'])->name('restaurant.deleteDish');
        Route::post('/restaurant/addDish', [RestaurantController::class, 'addDish'])->name('restaurant.addDish');
    });
});
