<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/tasks', 'App\Http\Controllers\TasksController@index')->name('tasks.index');
Route::post('/tasks', 'App\Http\Controllers\TasksController@store');
Route::get('/tasks/create', 'App\Http\Controllers\TasksController@create');
Route::get('/tasks/{task}', 'App\Http\Controllers\TasksController@show')->name('tasks.show');
Route::get('/tasks/{task}/edit', 'App\Http\Controllers\TasksController@edit');
Route::put('/tasks/{task}', 'App\Http\Controllers\TasksController@update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
