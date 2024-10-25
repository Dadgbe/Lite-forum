<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserProfileController;

Route::get('/', [ForumController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('authorization');
})->name('login');

Route::get('/register', function () {
    return view('registration');
})->name('register');

Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/personal_cabinet', function () {
    $user = Auth::user(); // Получаем текущего аутентифицированного пользователя
    return view('personal_cabinet', ['user' => $user]);
})->name('personal_cabinet');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/topic/create', [TopicController::class, 'create'])->name('topic.create');
Route::post('/topic', [TopicController::class, 'store'])->name('topic.store');
Route::get('/topics', [TopicController::class, 'index'])->name('topic.index');
Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topic.show');
Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->name('topic.edit');
Route::put('/topics/{topic}', [TopicController::class, 'update'])->name('topic.update');
Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->name('topic.destroy');
Route::get('/forum', 'TopicController@index')->name('forum.index');


Route::post('/messages', [MessageController::class, 'store'])->name('message.store');
Route::put('/messages/{message}', [MessageController::class, 'update'])->name('message.update');
Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('message.destroy');

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

Route::get('/user/{id}', [UserProfileController::class, 'show'])->name('user.profile');
