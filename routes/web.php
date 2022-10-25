<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProjectController;


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
    return view('auth.login');
});

Route::middleware('auth')->group(function() {
Route::get('/statuses', [StatusController::class, 'index']);
Route::get('statuses/create-page', [StatusController::class, 'create'])->name('create-page');
Route::post('statuses/create', [StatusController::class, 'store'])->name('create');
Route::get('statuses/edit/{statusId}', [StatusController::class, 'edit']);
Route::patch('statuses/update/{statusId}', [StatusController::class, 'update']);
Route::delete('statuses/destroy/{statusId}', [StatusController::class, 'destroy']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('projects/create-page', [ProjectController::class, 'create'])->name('create-page');
Route::post('projects/create', [ProjectController::class, 'store'])->name('create');
Route::get('projects/edit/{projectId}', [ProjectController::class, 'edit']);
Route::patch('projects/update/{projectId}', [ProjectController::class, 'update']);
Route::delete('projects/destroy/{projectId}', [ProjectController::class, 'destroy']);
});


require __DIR__ . '/auth.php';
