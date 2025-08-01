<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.login');
})->name('login');

Route::get('signup', function () {
    return view('pages.signup');
})->name('signup');

Route::get('home', function () {
    return view('pages.home');
})->name('home');

