<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLTEController;
use App\Http\Controllers\AdminLTEStudentController;

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
    return view('welcome');
});

// student
Route::get('/student/create', [StudentController::class,'create'])->name('student.create')->middleware('login_auth');
Route::post('/student', [StudentController::class, 'store'])->name('student.store')->middleware('login_auth');
Route::get('/student', [StudentController::class, 'index'])->name('student.index')->middleware('login_auth');
Route::get('/student/{student}', [StudentController::class,'show'])->name('student.show')->middleware('login_auth');
Route::get('/student/{student}/edit', [StudentController::class,'edit'])->name('student.edit')->middleware('login_auth');
Route::patch('/student/{student}', [StudentController::class,'update'])->name('student.update')->middleware('login_auth');
Route::delete('/student/{student}', [StudentController::class,'destroy'])->name('student.destroy')->middleware('login_auth');

// admins
Route::get('/login', [AdminController::class,'index'])->name('login.index');
Route::get('/logout', [AdminController::class,'logout'])->name('login.logout');
Route::post('/login', [AdminController::class,'process'])->name('login.process');

// adminlte 
Route::get('/adminlte/index', [AdminLTEController::class, 'index'])->name('adminlte.index');


// adminltestudent
Route::get('/adminlte/student/index', [AdminLTEStudentController::class, 'index'])->name('adminlte.student.index');
Route::get('/adminlte/student/create', [AdminLTEStudentController::class, 'create'])->name('adminlte.student.create');
Route::post('/adminlte/student/store', [AdminLTEStudentController::class, 'store'])->name('adminlte.student.store');
Route::get('/adminlte/student/show/{student_id}', [AdminLTEStudentController::class, 'show'])->name('adminlte.student.show');
Route::get('/adminlte/student/edit/{student_id}', [AdminLTEStudentController::class, 'edit'])->name('adminlte.student.edit');
Route::patch('/adminlte/student/update/{student_id}', [AdminLTEStudentController::class, 'update'])->name('adminlte.student.update');
Route::delete('/adminlte/student/destroy/{student_id}', [AdminLTEStudentController::class, 'destroy'])->name('adminlte.student.destroy');