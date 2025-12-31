<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('index');
// })->name('dashboard');

// dashboard
Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');


Route::get('/students',[StudentController::class,'index'])->name('student.index');
Route::get('/students/create',[StudentController::class,'create'])->name('student.create');
Route::post('/student/add',[StudentController::class,'store'])->name('student.store');
Route::delete('/student/delete/{id}',[StudentController::class,'destroy'])->name('student.destroy');
Route::get('/student/edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::put('/student/update/{id}',[StudentController::class,'update'])->name('student.update');
Route::get('/student/view/{id}',[StudentController::class,'view'])->name('student.view');

// courses
Route::get('/courses',[CourseController::class,'index'])->name('courses.index');
Route::get('/courses/create',[CourseController::class,'create'])->name('courses.create');
Route::post('/courses/add',[CourseController::class,'store'])->name('courses.add');
Route::delete('/courses/delete/{id}',[CourseController::class,'destroy'])->name('courses.delete');
Route::get('/courses/update/{id}',[CourseController::class,'update'])->name('courses.update');
Route::put('/courses/edit/{id}',[CourseController::class,'edit'])->name('courses.edit');

// attendance
Route::get('/attendance',[AttendanceController::class,'index'])->name('attendance.index');
Route::get('/attendance/render',[AttendanceController::class,'render'])->name('attendance.render');
Route::post('/attendance/store',[AttendanceController::class,'store'])->name('attendance.store');
Route::get('/attendance/history',[AttendanceController::class,'history'])->name('attendance.history');
Route::get('/attendance/view-history',[AttendanceController::class,'viewHistory'])->name('attendance.view-history');
Route::delete('/attendance/delete/{id}',[AttendanceController::class,'destroy'])->name('attendance.destroy');