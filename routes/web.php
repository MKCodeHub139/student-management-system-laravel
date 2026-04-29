<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\student\StudentDashboardController;
use App\Http\Controllers\teacher\TeacherDashboardController;


// Authentication
Route::get('/',function(){
    return redirect('/login');
});
// Route::get('/signup',[AuthController::class,'signup'])->name('auth.signup');
Route::get('/login',[AuthController::class,'index'])->name('auth.index');
Route::post('/login',[AuthController::class,'login'])->name('auth.login');
Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');
Route::get('/students',[StudentController::class,'index'])->name('student.index');
Route::get('/students/create',[StudentController::class,'create'])->name('student.create');
Route::post('/student/add',[StudentController::class,'store'])->name('student.store');
Route::delete('/student/delete/{id}',[StudentController::class,'destroy'])->name('student.destroy');
Route::get('/student/edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::put('/student/update/{id}',[StudentController::class,'update'])->name('student.update');
Route::get('/student/view/{id}',[StudentController::class,'view'])->name('student.view');

// teachers
Route::get('/teachers',[TeacherController::class,'index'])->name('teachers.index');
Route::get('/teachers/create',[TeacherController::class,'create'])->name('teachers.create');
Route::post('/teachers/store',[TeacherController::class,'store'])->name('teachers.store');


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
});
// exam
// student
Route::middleware('student')->prefix('/student')->group(function(){

    Route::get('/dashboard',[StudentDashboardController::class,'index']);
    Route::get('/check-exam',[StudentDashboardController::class,'checkExam'])->name('student.checkExam');
    Route::get('/exam-instructions/{id}',[StudentDashboardController::class,'examInstructions'])->name('student.examInstructions');
    Route::get('/start-exam/{id}',[StudentDashboardController::class,'startExam'])->name('student.startExam');
    Route::get('/view-results',[StudentDashboardController::class,'viewResults'])->name('student.viewResults');
    // Route::get('/start-exam',[StudentDashboardController::class,'startExamRender'])->name('exam.start-exam-render');
    Route::post('/start-exam/forward/{id}',[StudentDashboardController::class,'forward'])->name('exam.forward');
    Route::post('/start-exam/backward/{id}',[StudentDashboardController::class,'backward'])->name('exam.backward');
});

// teacher
Route::middleware('teacher')->prefix('/teacher')->group(function(){

    Route::get('/dashboard', [TeacherDashboardController::class,'index'])->name('teacher.index');
    Route::get('/view-examsheet',[TeacherDashboardController::class,'viewExamsheet'])->name('teacher.viewExamsheet');
    Route::get('/check-examsheet/{id}',[TeacherDashboardController::class,'checkExamsheet'])->name('teacher.checkExamsheet');
    Route::post('/submit-marks/{id}',[TeacherDashboardController::class,'submitMarks'])->name('teacher.submitMarks');

    // make question paper
    Route::get('/all-courses',[TeacherDashboardController::class,'allCourses'])->name('teacher.allCourses');
    Route::get('/make-question-paper/{id}',[TeacherDashboardController::class,'makeQuestionPaper'])->name('teacher.make-question-paper');
    Route::get('/generate-questions/{id}',[TeacherDashboardController::class,'generateQuestions'])->name('teacher.generateQuestions');
    Route::post('/save-question-paper/{id}',[TeacherDashboardController::class,'saveQuestionPaper'])->name('teacher.saveQuestionPaper');
});
