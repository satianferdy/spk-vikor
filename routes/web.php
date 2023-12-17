<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriteriaModelController;
use App\Http\Controllers\AlternatifModelController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\VikorMethodController;

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

Route::get('/dashboard', function () {
    return view('dashboard.home');
});

Route::prefix('/')->group (function () {
    Route::get('/', function () {
        return view('dashboard.home');
    });
    Route::resource('criteria', CriteriaModelController::class);
    Route::resource('alternatif', AlternatifModelController::class);
    Route::resource('decisionmatrix', DecisionMatrixController::class);
    Route::get('/calculate', [VikorMethodController::class, 'index'])->name('calculate.index');
});

// Route::resources([
//     'criteria' => CriteriaModelController::class,
//     'alternatif' => AlternatifModelController::class,
//     'decisionmatrix' => DecisionMatrixController::class,
// ]);

// Route::get('/calculate', [VikorMethodController::class, 'index'])->name('calculate.index');

// Route::get('/criteria', [CriteriaModelController::class, 'index'])->name('criteria.index');
// Route::get('/criteria/create', [CriteriaModelController::class, 'create'])->name('criteria.create');
// Route::post('/criteria', [CriteriaModelController::class, 'store'])->name('criteria.store');
// Route::get('/criteria/{criteria}', [CriteriaModelController::class, 'show'])->name('criteria.show');
// Route::get('/criteria/{criteria_models}/edit', [CriteriaModelController::class, 'edit'])->name('criteria.edit');
// Route::put('/criteria/{criteria_models}', [CriteriaModelController::class, 'update'])->name('criteria.update');
// Route::delete('/criteria/{criteria}', [CriteriaModelController::class, 'destroy'])->name('criteria.destroy');
// Route::resource('criteria', CriteriaModelController::class);

// Route::get('/alternatif', function () {
//     return view('alternatif.index');
// });

// Route::get('/alternatif/add', function () {
//     return view('alternatif.create');
// });
