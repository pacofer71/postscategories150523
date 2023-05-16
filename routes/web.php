<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Mails\ContactoController;
use App\Http\Controllers\Social\GithubController;
use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\ShowPosts;
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

Route::get('/', [WelcomeController::class, 'inicio'])->name('welcome.inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('posts', ShowPosts::class)->name('user.posts');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is_admin'
])->group(function () {
    Route::resource('categories', CategoryController::class);
});


Route::get('contacto', [ContactoController::class, 'index'])->name('contacto.form');
Route::post('contacto', [ContactoController::class, 'procesarFormContacto'])->name('contacto.procesar');
//---------------
Route::get('/auth/github/redirect', [GithubController::class, 'redirect'])->name('github.redirect');
Route::get('/auth/github/callback', [GithubController::class, 'callback'])->name('github.callback'); 