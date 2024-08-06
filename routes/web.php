<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRandomController;


Route::get('/', [ApiRandomController::class, 'index']);
Route::get('/static-people', [ApiRandomController::class, 'staticPeople']);
Route::post('/add-person', [ApiRandomController::class, 'addPerson'])->name('add-person');
Route::get('/remove-person/{id}', [ApiRandomController::class, 'removePerson'])->name('remove-person');

