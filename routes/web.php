<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriteriaModelController;
use App\Http\Controllers\AlternatifModelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.home');
});

Route::resources([
    'criteria' => CriteriaModelController::class,
    'alternatif' => AlternatifModelController::class,
]);

// Route::get('/alternatif', function () {
//     return view('alternatif.index');
// });

// Route::get('/alternatif/add', function () {
//     return view('alternatif.create');
// });
