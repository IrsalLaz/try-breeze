<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\Auth\RegisteredUserController;

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
Route::post('userStore', [RegisteredUserController::class, 'store']);
Route::get('userView', [RegisteredUserController::class, 'show'])->name('userView');

// Koleksi
Route::get('koleksi', [CollectionController::class, 'index'])->name('koleksi')->middleware(['auth', 'verified']);
// Route::get('koleksi/list', [CollectionController::class, 'getAll'])->name('koleksi.list')->middleware(['auth', 'verified']);

Route::get('koleksiTambah', [CollectionController::class, 'create'])->name('koleksiTambah')->middleware(['auth', 'verified']);
Route::post('koleksiStore', [CollectionController::class, 'store'])->name('koleksiStore')->middleware(['auth', 'verified']);
Route::get('koleksiView', [CollectionController::class, 'show'])->name('koleksiView')->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
