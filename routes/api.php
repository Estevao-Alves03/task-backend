<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::delete('/tasks/{task}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}', [TaskController:: class, 'show'])->name('tasks.show');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::get('/csrf-token', function() {
    return response()->json([
        'csrf_token' => csrf_token()
    ])->header('Access-Control-Allow-Origin', 'http://localhost:5174')
      ->header('Access-Control-Allow-Credentials', 'true');
});

Route::get('/teste', function () {
    return response()->json(['msg' => 'ok']);
});