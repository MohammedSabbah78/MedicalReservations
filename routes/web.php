<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AgeCheckMiddleware;
use App\Mail\AdminWelcomeEmail;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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


Route::prefix('cms')->middleware('guest:user,admin')->group(function () {
    Route::get('/{guard}/login', [AuthController::class, 'showLoginView'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('forgot-password', [ResetPasswordController::class, 'showForgotPassword'])->name('password.forgot');
    Route::post('forgot-password', [ResetPasswordController::class, 'sendResetLink']);
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPassword'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);
});


Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::post('roles/permissions', [RoleController::class, 'updateRolePermission']);
    Route::get('users/{user}/permissions/edit', [UserController::class, 'editUserPermission'])->name('user.edit-permissions');
    Route::put('users/{user}/permissions', [UserController::class, 'updateUserPermission'])->name('user.update-permissions');
});

Route::prefix('cms/admin')->middleware('auth:user,admin')->group(function () {
    Route::resource('cities', CityController::class);
    Route::resource('users', UserController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Route::get('news', function () {
//     echo 'New Content';
// })->middleware('ageCheck');

// Route::middleware('ageCheck')->group(function () {
//     Route::get('/news/1', function () {
//         echo 'New 1 Content';
//     })->withoutMiddleware('ageCheck');

//     Route::get('/news/2', function () {
//         echo 'New 2 Content';
//     });
// });

// Route::get('news', function () {
//     echo 'New Content';
// })->middleware(AgeCheckMiddleware::class);

Route::get('news', function () {
    echo 'New Content  ';
})->middleware('ageCheck:15');

// Route::get('test-email', function () {
//     return new AdminWelcomeEmail(Admin::first());
// });
