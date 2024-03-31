<?php

use App\Http\Controllers\TopInstrumentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/instruments/top/daily', [TopInstrumentsController::class, 'getDaily']);
Route::get('/instruments/top/weekly', [TopInstrumentsController::class, 'getWeekly']);
Route::get('/instruments/top/monthly', [TopInstrumentsController::class, 'getMonthly']);

