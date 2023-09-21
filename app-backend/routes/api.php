<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('/register',  [AuthController::class, 'register'])->name('register');
Route::post('/login',  [AuthController::class, 'login'])->name('login');

Route::prefix('news')->group(function() {
    Route::any('/list', [NewsController::class, 'list']);
    Route::get('/categories',  [NewsController::class, 'getCategories']);
    Route::get('/sources',  [NewsController::class, 'getSources']);
    Route::get('/authors',  [NewsController::class, 'getAuthors']);
    Route::post('/settings',  [UserController::class, 'setUserPreference']);
});

