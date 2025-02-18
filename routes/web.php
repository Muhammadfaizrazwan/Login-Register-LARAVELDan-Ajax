<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SiswaController;




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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/kategori', function () {
    return view('kategori');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/me', function(){
    return Auth::user();
})->name('me');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

Route::get('/home', [SiswaController::class, 'master'])->name('home');

Route::get('/home', [SiswaController::class, 'index'])->name('home');
Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');


