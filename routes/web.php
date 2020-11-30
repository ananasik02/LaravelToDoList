<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});


Route::get('/tasks', 'App\Http\Controllers\TasksController@index')->name('tasks.index');
Route::post('/tasks', 'App\Http\Controllers\TasksController@store');
Route::get('/tasks/create', 'App\Http\Controllers\TasksController@create');
Route::get('/tasks/{task}', 'App\Http\Controllers\TasksController@show')->name('tasks.show');
Route::get('/tasks/{task}/edit', 'App\Http\Controllers\TasksController@edit');
Route::put('/tasks/{task}', 'App\Http\Controllers\TasksController@update');

