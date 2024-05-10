<?php

use App\Http\Controllers\AntibioticController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\CultureOptionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\InvoiceController;

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


Route::prefix('v1')->group(function () {
    Route::resource('tests', TestController::class);
    Route::get('tests/price-list', [TestController::class, 'priceList']);

    Route::resource('cultures', CultureController::class);
    Route::get('cultures/price-list', [CultureController::class, 'priceList']);

    Route::resource('culture-options', CultureOptionController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('antibiotics', AntibioticController::class);
    Route::resource('invoices', InvoiceController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
