<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('employees', App\Http\Controllers\EmpController::class);


