<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamStudentController;
use App\Http\Controllers\ChildrenController;
use App\Models\Student;
use App\Http\Controllers\ProfileStudentController;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent' ]
    ], function(){

    Route::get('/parent/dashboard',function(){
        $sons = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.dashboard',compact('sons'));
    })->name('parents.dashboard');

    Route::get('children',[ChildrenController::class,'index'])->name('sons.index');
    Route::get('results/{id}', [ChildrenController::class,'results'])->name('sons.results');
    Route::get('attendaces', [ChildrenController::class,'attendaces'])->name('sons.attendaces');
    Route::post('attendaces_search', [ChildrenController::class,'attendacesSearch'])->name('sons.attendaces.search');
    Route::get('fee', [ChildrenController::class,'fee'])->name('sons.fee');
    Route::get('recipt/{id}', [ChildrenController::class,'recipt'])->name('sons.recipt');
    Route::get('profile/parent', [ChildrenController::class,'profile'])->name('paent.profile');
    Route::post('profile/parent/{id}', [ChildrenController::class,'profileUpdate'])->name('parent.profile.update');
});
