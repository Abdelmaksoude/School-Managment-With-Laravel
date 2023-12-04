<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PormotionController;
use App\Http\Controllers\GradutedStudentController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeInvoicesController;
use App\Http\Controllers\ReceiptStudentController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\PaymentStudentController;
use App\Http\Controllers\AttendanceStudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\OnlineController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\LoginController;

//Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('selection');

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');

    Route::post('/login',[LoginController::class,'login'])->name('login');

    Route::get('/logout/{type}',[LoginController::class,'logout'])->name('logout');

    });

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]
    ], function(){

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('grade', GradeController::class);
    Route::resource('classes', ClassRoomController::class);
    Route::post('filter', [ClassRoomController::class, 'filter'])->name('filter');
    Route::post('delete_all', [ClassRoomController::class,'delete_all'])->name('delete_all');
    Route::resource('section', SectionController::class);
    Route::get('/class/{id}', [SectionController::class, 'getclasses']);
    Route::resource('Teachers', TeacherController::class);
    Route::resource('Students', StudentController::class);
    Route::get('/Get_classrooms/{id}', [StudentController::class,'Get_classrooms']);
    Route::get('/Get_Sections/{id}', [StudentController::class,'Get_Sections']);
    Route::post('Upload_attachment', [StudentController::class,'Upload_attachment'])->name('Upload_attachment');
    Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class,'Download_attachment'])->name('Download_attachment');
    Route::post('Delete_attachment', [StudentController::class,'Delete_attachment'])->name('Delete_attachment');
    Route::resource('Promotion', PormotionController::class);
    Route::resource('Graduated', GradutedStudentController::class);
    Route::resource('Fees', FeeController::class);
    Route::resource('Fees_Invoices', FeeInvoicesController::class);
    Route::resource('receipt_students', ReceiptStudentController::class);
    Route::resource('ProcessingFee', ProcessingFeeController::class);
    Route::resource('Payment_students', PaymentStudentController::class);
    Route::resource('Attendance', AttendanceStudentController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('Exams', ExamController::class);
    Route::resource('quiz', QuizController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('online_classes', OnlineController::class);
    Route::get('/indirect', [OnlineController::class,'indirectCreate'])->name('indirect.create');
    Route::post('/indirect', [OnlineController::class,'storeIndirect'])->name('indirect.store');
    Route::resource('library', LibraryController::class);
    Route::get('download_file/{filename}', [LibraryController::class,'downloadAttachment'])->name('downloadAttachment');
    Route::resource('settings', SettingController::class);
});
Route::view('add_parent','livewire.show_Form')->name('add_parent');
