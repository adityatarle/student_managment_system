<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('students.dashboard');
})->middleware(['auth', 'verified', 'student'])->name('students.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

Route::get('/teachers/dashboard', function () {
    return view('teachers.dashboard');
})->middleware(['auth', 'verified', 'teacher'])->name('teachers.dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Admin: Can access all routes

    Route::resource('teachers', TeacherController::class)->middleware('admin');

    // Teachers: Can access only tasks, courses, and enrollments
    Route::resource('tasks', TaskController::class)->middleware('teacher');
    Route::resource('courses', CourseController::class)->middleware('admin_or_teacher');
    Route::resource('enrollments', EnrollmentController::class)->middleware('admin_or_teacher');
    Route::resource('students', StudentController::class)->middleware('admin_or_teacher');
    Route::resource('tasks', TaskController::class)->middleware('teacher');
    Route::get('/student-profile/{id}', [StudentController::class, 'show_profile'])->name('students.profile')->middleware('student');
    Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])
    ->name('tasks.toggle-status');







});

require __DIR__.'/auth.php';
