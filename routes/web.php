<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/tasks/{task}/delete', 'App\Http\Controllers\TasksController@destroy');
Route::put('/tasks/{task}/done', 'App\Http\Controllers\TasksController@markDone');

Route::get('/notifications', 'App\Http\Controllers\NotificationsController@index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
