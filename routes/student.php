<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamStudentController;
use App\Http\Controllers\ProfileStudentController;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student' ]
    ], function(){

    Route::get('/student/dashboard',function(){
        return view('pages.students.dashboard');
    });
    Route::resource('profile-student', ProfileStudentController::class);

});
Route::resource('student_exam', ExamStudentController::class)->middleware('auth:student');
