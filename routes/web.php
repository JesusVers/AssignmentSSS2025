<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('colleges.index');
});

Route::resource('colleges', CollegeController::class);
Route::resource('students', StudentController::class);

