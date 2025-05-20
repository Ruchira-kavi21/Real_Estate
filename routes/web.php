<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/lands', [PropertyController::class, 'land'])->name('lands');
Route::get('/rent', [PropertyController::class, 'rent'])->name('rent');
Route::get('/sell', [PropertyController::class, 'sell'])->name('sell.index');
Route::get('/sell/create', [PropertyController::class, 'create'])->name('sell.create');
Route::post('/sell', [PropertyController::class, 'store'])->name('sell.store');
Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe');

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/lands', [PropertyController::class, 'lands'])->name('lands');
// Route::get('/rent', [PropertyController::class, 'rent'])->name('rent');
// Route::get('/sell', [PropertyController::class, 'index'])->name('sell.index');
// Route::get('/sell/create', [PropertyController::class, 'create'])->name('sell.create');
// Route::post('/sell', [PropertyController::class, 'store'])->name('sell.store');
// Route::get('/about', [AboutController::class, 'index'])->name('about');
// Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
// Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe');

// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/dashboard', [\App\Http\Controllers\Admin\PropertyController::class, 'index'])->name('admin.dashboard');
//     Route::post('/properties/{property}/approve', [\App\Http\Controllers\Admin\PropertyController::class, 'approve'])->name('admin.properties.approve');
//     Route::post('/properties/{property}/decline', [\App\Http\Controllers\Admin\PropertyController::class, 'decline'])->name('admin.properties.decline');
// });