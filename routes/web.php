<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;

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

Route::get('/', [BackController::class,'showLoginForm'])->name('login.form');

Route::post('/login',[BackController::class,'loginStoreToken'])->name('login.store.token');
Route::group(['middleware' => 'user.token'], function () {
    Route::get('/authors-listing',[BackController::class,'authorsIndex'])->name('author.home');
    Route::get('/author-edit/{id}',[BackController::class,'viewAuthor'])->name('author.edit');
    Route::get('/author-book-delete/{bookId}',[BackController::class,'deleteBook'])->name('author.book.delete');
    Route::get('/author-delete/{authorId}',[BackController::class,'deleteAuthor'])->name('author.delete');
    Route::get('/author-add-book',[BackController::class,'addBook'])->name('user.add.book');
    Route::post('/save-book',[BackController::class,'saveBook'])->name('author.save.book');
    Route::get('/user-logout',[BackController::class,'logout'])->name('user.logout');
});


