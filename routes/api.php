<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\RegistrationController;
use \App\Http\Controllers\CityController;
use \App\Http\Controllers\IdentificationDocumentTypeController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(UserController::class)->group(function() {
    Route::get('users', 'index');
    Route::get('users/{id}', 'show');
});

Route::controller(RegistrationController::class)->group(function() {
   Route::get('registrations', 'index');
   Route::get('registrations/{id}', 'show');
   Route::delete('registrations/{id}', 'reject');
   Route::put('registrations/{id}', 'approve');
});

Route::post('/register', [RegisterController::class, '__invoke']);

Route::controller(CityController::class)->group(function() {
    Route::get('cities', 'index');
});

Route::controller(IdentificationDocumentTypeController::class)->group(function() {
    Route::get('documents/types', 'index');
});
