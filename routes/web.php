<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpellController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Spell copying routes
Route::middleware(['auth'])->group(function () {
    Route::post('/spells/{spell}/copy', [SpellController::class, 'copy'])->name('spells.copy');
    Route::delete('/spells/{spell}/remove', [SpellController::class, 'remove'])->name('spells.remove');
});

// Authentication routes
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

// Redirect to Filament auth routes
Route::get('/login', function () {
    return redirect()->route('filament.app.auth.login');
})->name('login');

Route::get('/register', function () {
    return redirect()->route('filament.app.auth.register');
})->name('register');
