<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('college.index');
});

// College Routes (Singular)
Route::get('/college', [CollegeController::class, 'index'])->name('college.index');
Route::get('/college/create', [CollegeController::class, 'create'])->name('college.create');
Route::post('/college', [CollegeController::class, 'store'])->name('college.store');
Route::get('/college/{id}/edit', [CollegeController::class, 'edit'])->name('college.edit');
Route::put('/college/{id}', [CollegeController::class, 'update'])->name('college.update');
Route::delete('/college/{id}', [CollegeController::class, 'destroy'])->name('college.destroy');

// Student Routes (Singular)
Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
