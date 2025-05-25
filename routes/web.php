<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Models\Property;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
})->name('root');

Route::get('/home', [PropertyController::class, 'home'])->name('home');
Route::get('/land', [PropertyController::class, 'land'])->name('land');
Route::get('/rent', [PropertyController::class, 'rent'])->name('rent');
Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

// User authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

// Seller routes
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/sell', [PropertyController::class, 'showSellForm'])->name('sell');
    Route::post('/sell', [PropertyController::class, 'store'])->name('sell.store');
});
Route::get('/user/view/{id}', [PropertyController::class, 'viewProperty'])->name('user.view');


// Route::get('/Admin/dashboard', [AdminController::class, 'dashboard'])->name('admin');
Route::get('/Admin/dashboard', [AdminController::class, 'dashboard'])->name('admin');
Route::post('/admin/approve/{id}', [AdminController::class, 'approveProperty'])->name('admin.approve');
Route::post('/admin/decline/{id}', [AdminController::class, 'declineProperty'])->name('admin.decline');
Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('admin.create');
Route::post('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin.edit-user');
Route::post('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
Route::get('/admin/add-property', [AdminController::class, 'showAddPropertyForm'])->name('admin.add-property');
Route::post('/admin/add-property', [AdminController::class, 'addProperty'])->name('admin.add-property.store');
Route::get('/admin/edit-property/{id}', [AdminController::class, 'editPropertyView'])->name('admin.edit-property');
Route::post('/admin/edit-property/{id}', [AdminController::class, 'editProperty'])->name('admin.edit-property.store');
Route::post('/admin/delete-property/{id}', [AdminController::class, 'deleteProperty'])->name('admin.delete-property');
Route::get('/admin/list', [AdminController::class, 'listProperties'])->name('admin.list');
Route::get('/admin/view/{id}', [AdminController::class, 'viewProperty'])->name('admin.view');
Route::get('/admin/export-report', [AdminController::class, 'exportPropertyReport'])->name('admin.export-report');
// Admin routes
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     // Route::get('/Admin/dashboard', [AdminController::class, 'dashboard'])->name('admin');
//     Route::post('/admin/approve/{id}', [AdminController::class, 'approveProperty'])->name('admin.approve');
//     Route::post('/admin/decline/{id}', [AdminController::class, 'declineProperty'])->name('admin.decline');
//     Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('admin.create');
//     Route::post('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin.edit-user');
//     Route::post('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
//     Route::post('/admin/add-property', [AdminController::class, 'addProperty'])->name('admin.add-property');
//     Route::post('/admin/edit-property/{id}', [AdminController::class, 'editProperty'])->name('admin.edit-property');
//     Route::post('/admin/delete-property/{id}', [AdminController::class, 'deleteProperty'])->name('admin.delete-property');
//     Route::get('/admin/export-report', [AdminController::class, 'exportPropertyReport'])->name('admin.export-report');
// });