<?php

use App\Http\Controllers\authentications\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\RegisterController;
use App\Http\Controllers\pages\PemilikController;
use App\Http\Controllers\pages\PencariController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomePage::class, 'index'])->name('home');
Route::get('/chat', [HomePage::class, 'chat'])->name('chat');
Route::get('/getMessageById', [HomePage::class, 'getMessageById'])->name('chat.getMessageById');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register-pemilik', [RegisterController::class, 'pemilik'])->name('pemilik');
Route::get('/register-pencari', [RegisterController::class, 'pencari'])->name('pencari');
Route::post('/login', [AuthController::class, 'login_action'])->name('login.action');
Route::post('/register-pemilik-add', [RegisterController::class, 'pemilik_add'])->name('pemilik.action.add');
Route::post('/register-pencari-add', [RegisterController::class, 'pencari_add'])->name('pencari.action.add');
// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/getLotlat', [HomePage::class, 'getLotlat'])->name('user.getLotlat');
Route::get('/searchgetLotlat', [HomePage::class, 'searchgetLotlat'])->name('user.searchgetLotlat');
Route::get('/getMessage', [HomePage::class, 'getMessage'])->name('user.getMessage');
Route::post('/messgaeSend', [HomePage::class, 'messgaeSend'])->name('messgaeSend');
Route::post('/getLotlatNotRoute', [HomePage::class, 'getLotlatNotRoute'])->name('getLotlatNotRoute');
Route::post('/getLotlatNotRouteParams', [HomePage::class, 'getLotlatNotRouteParams'])->name('getLotlatNotRouteParams');
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logoutFix');
    Route::get('/logout_users', [AuthController::class, 'logout_users'])->name('logout_usersFix');
    Route::get('/dashboard', [HomePage::class, 'dashboard'])->name('pages-home');
    Route::get('/pemilik-list', [PemilikController::class, 'pemilik'])->name('pemilik-list');
    Route::post('/update-pemilik', [PemilikController::class, 'updatePemilik'])->name('update-pemilik');
    Route::get('/pencari-list-data', [PencariController::class, 'pencari'])->name('pencari-list');
    Route::post('/giveRating', [HomePage::class, 'giveRating'])->name('giveRating');
    Route::get('/jasaPemilik', [HomePage::class, 'jasaPemilik'])->name('jasaPemilik');
});
// // authentication
// Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
// Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login');
// Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');

// // Main Page Route
// Route::get('/home', [HomePage::class, 'index'])->name('pages-home');
// Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');
