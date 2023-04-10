<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PokemonController;
use App\Http\Middleware\AdminMiddleware;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/pokemons/{next_url?}', [PokemonController::class,'index'])->name('pokemons');
    Route::get('/downloadListPokemons', [PokemonController::class,'downloadListPokemons'])->name('downloadListPokemons');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'isAdmin'
])->prefix('admin')->group(function () {
    Route::get('/upload-spreadsheet', [AdminController::class, 'showSpreadsheetUploadToRegisterUsers'])->name('show.register-users');
    Route::post('/upload-spreadsheet', [AdminController::class, 'storeSpreadsheetUploadToRegisterUsers'])->name('store.spreadsheet-users');
    Route::get('/download-template-spreadsheet', [AdminController::class, 'downloadTemplateSpreadsheet'])->name('download.template-spreadsheet');
});


