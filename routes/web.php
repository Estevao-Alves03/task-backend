<?php

use Illuminate\Support\Facades\Route;

Route::get('/teste', function () {
    return response()->json(['msg' => 'API funcionando']);
});


Route::get('/', function () {
    return view('welcome');
});

