<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/undercover/offline', function () {
    return view('undercover-offline');
});
