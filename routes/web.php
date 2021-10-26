<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Student;
use App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index']);

Route::get('home', HomeController::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('home', [Admin\HomeController::class, 'index'])->name('home');

        Route::get('students/{student_id}/restore', [Admin\StudentController::class, 'restore'])->name('students.restore');
        Route::resource('students', Admin\StudentController::class);

        Route::resource('students.attendances', Admin\StudentAttendanceController::class)->only('index');

        Route::get('payments/{payment_id}/restore', [Admin\PaymentController::class, 'restore'])->name('payments.restore');
        Route::resource('payments', Admin\PaymentController::class);

        Route::get('teachers/{teacher_id}/restore', [Admin\TeacherController::class, 'restore'])->name('teachers.restore');
        Route::resource('teachers', Admin\TeacherController::class);

        Route::resource('teachers.attendances', Admin\TeacherAttendanceController::class)->only('index');

        Route::get('subjects/{subject_id}/restore', [Admin\SubjectController::class, 'restore'])->name('subjects.restore');
        Route::resource('subjects', Admin\SubjectController::class);

        Route::get('semesters/{semester_id}/restore', [Admin\SemesterController::class, 'restore'])->name('semesters.restore');
        Route::resource('semesters', Admin\SemesterController::class)->except('show', 'edit');

        Route::get('classrooms/{classroom_id}/restore', [Admin\ClassroomController::class, 'restore'])->name('classrooms.restore');
        Route::resource('classrooms', Admin\ClassroomController::class);

        Route::get('schedules/{schedule_id}/restore', [Admin\ClassroomScheduleController::class, 'restore'])->name('schedules.restore');
        Route::resource('classrooms.schedules', Admin\ClassroomScheduleController::class)->shallow();

        Route::resource('classrooms.students', Admin\ClassroomStudentController::class)->only('update', 'destroy');

        Route::resource('information', Admin\InformationController::class)->only('index', 'edit', 'update');
    });

    Route::middleware('role:teacher')->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('home', [Teacher\HomeController::class, 'index'])->name('home');

        Route::post('notifications/send-message/classrooms/{classroom}', [Teacher\NotificationController::class, 'store'])->name('notifications.store');

        Route::resource('schedules', Teacher\ScheduleController::class)->only('index', 'edit', 'update');

        Route::resource('schedules.attendances', Teacher\ScheduleAttendanceController::class)->only('create', 'store');

        Route::resource('classrooms', Teacher\ClassroomController::class)->only('index', 'show');

        Route::resource('classrooms.students', Teacher\ClassroomStudentController::class)->only('show');
    });

    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        Route::get('home', [Student\HomeController::class, 'index'])->name('home');

        Route::put('notifications/mark-as-read', [Student\NotificationController::class, 'update'])->name('notifications.update');

        Route::resource('schedules', Student\ScheduleController::class)->only('index');

        Route::resource('classrooms', Student\ClassroomController::class)->only('index', 'show', 'update');

        Route::resource('payments', Student\PaymentController::class)->only('index', 'show', 'update');
    });
});
