<?php

use App\Http\Controllers\PaymentController;
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
    return view('welcome');
});

Route::get('/',[PaymentController::class,'createPayment']);
Route::get('/newpayment',[PaymentController::class,'createPayment']);

Route::POST('/checkout',[PaymentController::class,'checkout']);
// Route::GET('success',[PaymentController::class,'onSuccess']);
// Route::GET('error',[PaymentController::class,'onError']);
