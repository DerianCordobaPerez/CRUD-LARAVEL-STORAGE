<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/student/add', [StudentController::class, 'renderAdd']);
Route::post('/student/add', [StudentController::class, 'add']);

Route::get('/student/edit/{license}', [StudentController::class, 'renderEdit']);
Route::post('/student/edit', [StudentController::class, 'edit']);

Route::get('/student/delete/{license}', [StudentController::class, 'renderDelete']);
Route::post('/student/delete', [StudentController::class, 'delete']);

Route::get('/student/list', [StudentController::class, 'renderList']);

Route::get('/teacher/add', [TeacherController::class, 'renderAdd']);
Route::post('/teacher/add', [TeacherController::class, 'add']);

Route::get('/teacher/edit/{inss}', [TeacherController::class, 'renderEdit']);
Route::post('/teacher/edit', [TeacherController::class, 'edit']);

Route::get('/teacher/delete/{inss}', [TeacherController::class, 'renderDelete']);
Route::post('/teacher/delete', [TeacherController::class, 'delete']);

Route::get('/teacher/list', [TeacherController::class, 'renderList']);
