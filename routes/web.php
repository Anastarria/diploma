<?php

use App\Models\Book;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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
Route::get('clear', function () {
    Log::debug('CLEARED');
    Artisan::call('cache:clear');
});

Route::get('/', 'App\Http\Controllers\BookController@index');
Route::post('/books/genre/{genre}', 'App\Http\Controllers\BookController@sortByGenre');

Route::get('/checkemail', function () {
    return view('Auth.checkemail');
});

Route::get('books/info/{id}', 'App\Http\Controllers\BookController@showSingleBook');
Route::get('books/read', 'App\Http\Controllers\BookController@readBook');

Route::middleware(\App\Http\Middleware\isAdmin::class)->group(function (){
    Route::get('profile/info', 'App\Http\Controllers\ProfileController@showProfile');
    Route::get('profile/edit', 'App\Http\Controllers\ProfileController@editProfilePage');
    Route::post('profile/edit', 'App\Http\Controllers\ProfileController@updateProfile');

    Route::get('books/create', 'App\Http\Controllers\BookController@createBookPage');
    Route::post('books/create', 'App\Http\Controllers\BookController@createBook');
    Route::get('books/edit/{id}', 'App\Http\Controllers\BookController@updateBookPage');
    Route::post('books/edit/{id}', 'App\Http\Controllers\BookController@updateBook');
    Route::post('books/delete/{id}', 'App\Http\Controllers\BookController@deleteBook');
    Route::post('books/edit/cover/{id}', 'App\Http\Controllers\BookController@changeCover');

    Route::post('editavatar', 'App\Http\Controllers\UserAvatarController@update');
    Route::post('deleteavatar', 'App\Http\Controllers\UserAvatarController@delete');
});

Route::post('books/bookmark/add', 'App\Http\Controllers\BookMarksController@addBookmark');
Route::post('books/bookmark/remove', 'App\Http\Controllers\BookMarksController@removeBookmark');

Route::post('books/comment/create', 'App\Http\Controllers\CommentController@createComment');
Route::post('books/comment/delete/{id}', 'App\Http\Controllers\CommentController@deleteComment');

Route::get('login', 'App\Http\Controllers\AuthController@showLoginForm');
Route::get('register', 'App\Http\Controllers\AuthController@showRegistrationForm');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::get('logout', 'App\Http\Controllers\AuthController@logout');




Route::get('invite', function (\Illuminate\Http\Request $request) {
    $hash = $request->input('hash');

    /** @var \App\Models\UserVerification $uv */
    $uv = \App\Models\UserVerification::query()
        ->where('hash', $hash)
        ->firstOrFail();

    /** @var \App\Models\User $user */
    $user = \App\Models\User::query()->where('id', $uv->user_id)->first();

    $user->email_verified = 1;
    $user->save();
    $uv->delete();

    \Illuminate\Support\Facades\Auth::login($user);

    return view('Auth.emailverified');
});
