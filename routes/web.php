<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'getInfo'])->name('getProfileInfo');
    Route::post('/update_profile', [UserController::class, 'updateInfo'])->name('updateProfileInfo');
    Route::get('/favorites', [MainController::class, 'favorites'])->name('favorites');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/leagues', [MainController::class, 'getLeagues'])->name('getLeagues');
Route::get('/teams', [MainController::class, 'getTeams'])->name('getTeams');
Route::get('/team', [MainController::class, 'getTeamInfo'])->name('getTeamInfo');
Route::post('/handleFavorites', [MainController::class, 'handleFavorites'])->name('handleFavorites');


require __DIR__.'/auth.php';
