<?php

use App\Http\Livewire\Article\Article;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Index\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/register', Register::class)->name('index-register')->middleware('guest');
Route::get('/login', Login::class)->name('index-login')->middleware('guest');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('index-home');
})->name('index-logout')->middleware('auth');
Route::get('/', Index::class)->name('index-home');
//Route::get('/article/{id}', Article::class)->name('index-article')->middleware('can:is_admin');
Route::get('/article/{id}', Article::class)->name('index-article');
