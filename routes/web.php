<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\LogController;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){

    // INICIO
	Route::get('/tareas', [TaskController::class, 'index'])
        ->name('task');

    // MIS TAREAS 
    Route::get('/mis-tareas', [TaskController::class, 'my'])
        ->name('task.my');

    // MIS TAREAS 
    Route::get('/tarea/nueva', [TaskController::class, 'create'])
        ->name('task.create');

    // CREAR TAREA
    Route::post('/tarea/store', [TaskController::class, 'store'])
        ->name('task.store');

    // EDITAR TAREA
    Route::get('/tarea/{task}/editar', [TaskController::class, 'edit'])
        ->name('task.edit');

    // ACTUALIZAR LOG
	Route::put('/tarea/actualiza/{task}', [TaskController::class, 'update'])
        ->name('task.update');

    // LOG
	Route::get('/tareas/{task}/log', [TaskController::class, 'log'])
        ->name('task.log');

    // CREAR LOG
	Route::post('/log/store/{task}', [LogController::class, 'store'])
        ->name('log.store');

});