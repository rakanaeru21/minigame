<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/undercover/offline', function () {
    return view('undercover-offline');
});

Route::get('/undercover/play', function () {
    return view('undercover-play');
});
