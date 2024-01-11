<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Books;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\User\Login;
use App\Http\Controllers\User\Registration;
use App\Http\Controllers\User\User;
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

Route::get('/', function () {return view('welcome');})->name('welcome');

Route::get('/registration', function () {
    session()->forget('user');
    session()->forget('userRole');
    return view('registration');})->name('registration');
Route::post('/registration', [Registration::class, 'register'])->name('registrationPost');


Route::get('/login', function () {
    if (session()->exists('user')) {
        return redirect()->route('welcome');
    }
    return view('login');
})->name('login');
Route::post('/login', [Login::class, 'login'])->name('loginPost');

Route::get('/logout', function () {
    session()->forget('user');
    session()->forget('userRole');
    return redirect()->route('welcome');
})->name('logout');

Route::get('/books', [Books::class, 'books'])->name('books');
Route::get('/books/{id}', [Books::class, 'show'])->name('bookId');

Route::get('/admin/books', [Admin::class, 'maintainBooks'])->name('maintainBooks');

Route::get('/admin/addBook', [Admin::class, 'addBook'])->name('addBook');
Route::post('/admin/addBook', [Admin::class, 'addBookPost'])->name('addBookPost');

Route::get('/admin/users', [Admin::class, 'maintainUsers'])->name('maintainUsers');

Route::get('/user/cart', [User::class, 'showCart'])->name('showCart');
Route::get('/user/books', [User::class, 'showBooks'])->name('showBooks');

// Route::post('/books/{id}', [User::class, 'addToCart'])->name('addToCart');
// Route::post('/books/{id}', [User::class, 'borrowBook'])->name('borrowBook');
Route::post('/books/{id}/addToCart', [User::class, 'addToCart'])->name('addToCart');
Route::post('/books/{id}/borrowBook', [User::class, 'borrowBook'])->name('borrowBook');

Route::get('/user/summary', [User::class, 'summary'])->name('summary');
Route::post('/user/summary', [User::class, 'summaryPost'])->name('summaryPost');

Route::post('/books/{id}/rateBook', [User::class, 'rateBook'])->name('rateBook');

Route::post('/books', [Books::class, 'categoryFilter'])->name('categoryFilter');

Route::get('/user/history', [HistoryController::class, 'index'])->name('history');
