<?php

use App\Http\Livewire\Article\Article;
use App\Http\Livewire\Index\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('index-home');
Route::get('/article/{id}', Article::class)->name('index-article');
