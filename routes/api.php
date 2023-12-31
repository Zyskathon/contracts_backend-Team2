<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/send-email', [MailController::class, 'sendEmail']);

// Route::post('/login', [UserController::class, 'login']);

Route::group(['controller' => UserController::class], function () {
    Route::post('login', 'login');
    Route::get('user', 'userDetails')->middleware('auth:api');
});

Route::group([ 'controller' => EmployeeController::class], function () {
    // Route::post('create/employee', 'store');
    Route::get('employee/{id}', 'show');
    Route::delete('delete/{id}', 'destroy');
    Route::get('employees', 'index');
});
Route::post('create/employee', [EmployeeController::class,'store']);

Route::get('list/contracts', [ContractController::class, 'list']);
Route::get('list/contracts/{id}', [ContractController::class, 'detail']);

Route::get('contracts/{contractid}/', [ContractController::class, 'detail']);


Route::group(['middleware' => ['auth:api'], 'controller' => ContractController::class], function () {
    Route::post('attach-employee/{contractId}', 'attachEmployee');
});
Route::post('create/contract', [ContractController::class, 'create']);
Route::get('contracts', [ContractController::class, 'details']);
