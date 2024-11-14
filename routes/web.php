<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/retry', [DashboardController::class, 'retry'])->name('retry');
Route::get('/examples', [DashboardController::class, 'examples'])->name('examples');

Route::get('/logs', function () {
    $filePath = storage_path('logs/background-jobs.log');
    File::exists($filePath) ?: File::put($filePath, '');
    $logContent = File::get($filePath);

    return view('log_viewer', ['logs' => $logContent]);
})->name('logs.view');

Route::get('/error_logs', function () {
    $errorFilePath = storage_path('logs/background-jobs-error.log');
    File::exists($errorFilePath) ?: File::put($errorFilePath, '');
    $logContent = File::get($errorFilePath);

    return view('log_viewer', ['logs' => $logContent]);
})->name('error_logs.view');




//Route::get('/jobs', 'JobDashboardController@index');
//Route::get('/jobs/{id}', 'JobDashboardController@show');
//Route::delete('/jobs/{id}', 'JobDashboardController@cancel');
//
//Route::get('/jobs', [JobDashboardController::class, 'getJobs']);
//Route::get('/jobs/{id}', [JobDashboardController::class, 'getJobDetails']);
//Route::delete('/jobs/{id}', [JobDashboardController::class, 'cancelJob']);
