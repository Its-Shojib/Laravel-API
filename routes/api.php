<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return ['name'=>"Shojib", 'email'=>"mdshojib922@gmail.com"];
});

Route::get('/users', [StudentController::class, 'getUser']);
Route::post('/users', [StudentController::class, 'createUser']);
Route::put('/users/{id}', [StudentController::class, 'updateUser']);