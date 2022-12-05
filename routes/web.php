<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;


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

Route::get('googleChart', [GoogleController::class, 'googlepiechart']);

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

Route::get('/invoices', [InvoiceController::class, 'index']);
Route::get('invoices/create-invoice', [InvoiceController::class, 'create'])->name('create-invoice');
Route::post('invoices/create', [InvoiceController::class, 'store'])->name('create');
Route::get('invoices/edit/{invoiceId}', [InvoiceController::class, 'edit']);
Route::patch('invoices/update/{invoiceId}', [InvoiceController::class, 'update']);
Route::delete('invoices/destroy/{invoiceId}', [InvoiceController::class, 'destroy']);

Route::get('/payments', [PaymentController::class, 'index']);
Route::get('/add-payment/{invoiceId}', [PaymentController::class, 'paymentindex'])->name('add-payment');
Route::get('/payments/create-payment/{invoiceId}', [PaymentController::class, 'create'])->name('create-payment');
Route::post('/payments/create', [PaymentController::class, 'store'])->name('create');
Route::get('/payments/edit/{invoiceId}', [PaymentController::class, 'edit']);
Route::patch('/payments/update', [PaymentController::class, 'update']);
Route::post('/payments/destroy{invoiceId}', [PaymentController::class, 'destroy']);
Route::get('/payments/edit/{invoiceId}', [PaymentController::class, 'edit']);
Route::patch('/payments/update/{paymentId}', [PaymentController::class, 'update']);

Route::get('invoices/print/{invoiceId}',  [InvoiceController::class, 'generateInvoice']);
});


require __DIR__ . '/auth.php';
