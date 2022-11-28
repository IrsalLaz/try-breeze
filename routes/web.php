<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('about', [AboutController::class, 'index'])->name('about');
Route::get('items', [ItemController::class, 'index'])->name('items');

// User
Route::get('user', [RegisteredUserController::class, 'index'])->name('user');

Route::get('userRegistration', [RegisteredUserController::class, 'create'])->name('userRegistration');
Route::get('addUser', [RegisteredUserController::class, 'addUser'])->name('addUser');
Route::post('userStore', [RegisteredUserController::class, 'store']);
Route::get('userView/{user}', [RegisteredUserController::class, 'show'])->name('userView');
Route::post('userUpdate/{id}', [RegisteredUserController::class, 'update'])->name('userUpdate');

// Koleksi
Route::get('koleksi', [CollectionController::class, 'index'])->middleware(['auth', 'verified'])->name('koleksi');
Route::get('koleksiTambah', [CollectionController::class, 'create'])->name('koleksiTambah');
Route::post('koleksiStore', [CollectionController::class, 'store'])->middleware(['auth', 'verified'])->name('koleksiStore');

Route::get('koleksiView/{collection}', [CollectionController::class, 'show'])->middleware(['auth', 'verified'])->name('koleksiView');
Route::post('koleksiUpdate/{id}', [CollectionController::class, 'update'])->middleware(['auth', 'verified'])->name('koleksiUpdate');
Route::post('koleksiEdit', [CollectionController::class, 'edit'])->middleware(['auth', 'verified'])->name('koleksiEdit');

require __DIR__ . '/auth.php';
