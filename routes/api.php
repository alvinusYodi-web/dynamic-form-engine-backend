<?php

use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/form', [FormController::class, 'index']);
Route::post('/form', [FormController::class, 'store']);
