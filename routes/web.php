<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\VacancyCRUDController;
  
Route::get('vacancies', [VacancyCRUDController::class, 'index']);
Route::get('add-vacancy', [VacancyCRUDController::class, 'create']);
Route::post('save-vacancy', [VacancyCRUDController::class, 'store']);
Route::get('edit/{id}', [VacancyCRUDController::class, 'edit']);
Route::post('update', [VacancyCRUDController::class, 'update']);
Route::get('delete/{id}', [VacancyCRUDController::class, 'destroy']);