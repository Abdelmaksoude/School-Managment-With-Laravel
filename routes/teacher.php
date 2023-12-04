<?php

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QuizTeacherController;
use App\Http\Controllers\QuestionTeacherController;
use App\Http\Controllers\ProfileTeacherController;
use App\Http\Controllers\OnlineTeacherController;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher' ]
    ], function(){

    Route::get('/teacher/dashboard',function(){
        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections']= $ids->count();
        $data['count_students']= Student::whereIn('section_id',$ids)->count();
        return view('pages.teachers.dashboard',$data);
    });
    Route::get('student', [StudentController::class,'dashboard'])->name('student.index');
    Route::get('sections', [StudentController::class,'sections'])->name('sections');
    Route::post('attendance', [StudentController::class,'attendance'])->name('attendance');
    Route::get('attendanceReport', [StudentController::class,'attendanceReport'])->name('attendanceReport');
    Route::post('attendanceSearch', [StudentController::class,'attendanceSearch'])->name('attendance.search');
    Route::resource('quizzes', QuizTeacherController::class);
    Route::get('/GetClassrooms/{id}', [QuizTeacherController::class,'GetClassrooms']);
    Route::get('/GetSections/{id}', [QuizTeacherController::class,'GetSections']);
    Route::resource('questions', QuestionTeacherController::class);
    Route::resource('online_zoom', OnlineTeacherController::class);
    // Route::resource('profile', ProfileTeacherController::class);
    Route::get('profile', [ProfileTeacherController::class,'index'])->name('profile.show');
    Route::post('profile/{id}', [ProfileTeacherController::class,'update'])->name('profile.update');
    Route::get('student_quizze/{id}',[QuizTeacherController::class,'student_quizze'])->name('student.quizze');
    Route::post('repeat_quizze', [QuizTeacherController::class,'repeat_quizze'])->name('repeat.quizze');
});
