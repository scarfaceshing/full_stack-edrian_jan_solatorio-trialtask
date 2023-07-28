<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;
use App\Models\User;

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

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum', 'ability:is-admin,is-user'])->prefix('v1')->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'ability:is-admin'])->prefix('v1')->group(function () {
    Route::resource('user', UserController::class);
});