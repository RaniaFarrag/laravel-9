<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthenticationController::class)->group(function (){
   Route::post('register', 'register');
   Route::post('login', 'login');

   Route::middleware('auth:sanctum')->post('logout', 'logout');

});

Route::middleware(['auth:sanctum', 'checkinternet.connection'])->group(function (){
   Route::resource('products', ProductController::class);
   Route::get('send/email', [EmailController::class, 'sendWelcomeEmail']);

//   Route::get('export', [ProductController::class, 'export']);
    Route::post('/import', [ProductController::class, 'import']);

});
//to test from browser
Route::get('/export', [ProductController::class, 'export']);





