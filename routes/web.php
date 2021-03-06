<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if (Auth::user())
        return redirect('/projects');

    return redirect('/login');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [UserController::class, 'displayLoginPage'])->name('login');
    Route::post('/login', [UserController::class, 'authenticate']);
    Route::get('/register', [UserController::class, 'displayRegisterPage']);
    Route::post('/register', [UserController::class, 'store']);
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/projects', [ProjectController::class, 'displayDashboard']);
    Route::get('/projects/create', [ProjectController::class, 'displayCreatePage']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/join', [ProjectController::class, 'displayJoinPage']);
    Route::get('/projects/join/{project}', [ProjectController::class, 'displayJoinDetailPage']);
    Route::post('/projects/join', [ProjectController::class, 'storeShowJoin']);
    Route::post('/projects/join/store', [ProjectController::class, 'storeJoin']);

    Route::group(['middleware' => ['ownedproject']], function () {
        Route::get('/projects/{project}', [ProjectController::class, 'displayDetailPage']);
        Route::get('/projects/edit/{project}', [ProjectController::class, 'displayEditPage']);
        Route::put('/projects/{project}', [ProjectController::class, 'update']);
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

        Route::get('projects/{project}/tasks/create', [TaskController::class, 'displayCreatePage']);
        Route::post('projects/{project}/tasks', [TaskController::class, 'store']);
        Route::get('projects/{project}/tasks/{task}', [TaskController::class, 'displayDetailPage']);
        Route::get('projects/{project}/tasks/edit/{task}', [TaskController::class, 'displayEditPage']);
        Route::put('projects/{project}/task/{task}', [TaskController::class, 'update']);
        Route::delete('projects/{project}/task/{task}', [TaskController::class, 'destroy']);
    });
});