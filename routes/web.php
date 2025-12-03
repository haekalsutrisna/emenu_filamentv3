<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{username}', [FrontendController::class, 'index'])->name('index');