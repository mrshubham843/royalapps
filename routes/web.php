<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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
    return view('login');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/CheckAuth', [AuthController::class, 'CheckAuth'])->name('CheckAuth');

Route::middleware(['auth:web'])->group(
    function () {
        Route::get('/listAuthors', [AuthController::class, 'listAuthors'])->name('listAuthors');
        Route::get('/viewBooks/{id?}', [AuthController::class, 'viewBooks'])->name('viewBooks');
        Route::get('/deleteAuthor/{id?}', [AuthController::class, 'deleteAuthor'])->name('deleteAuthor');
        Route::get('/deleteBook/{id?}', [AuthController::class, 'deleteBook'])->name('deleteBook');
        Route::get('/addBook', [AuthController::class, 'addBook'])->name('addBook');
        Route::post('/saveBook', [AuthController::class, 'saveBook'])->name('saveBook');
        Route::get('/profile', function () {
            return view('profile');
        })->name('profile');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    }
);
