<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamStudentController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('grade_id', auth()->user()->Grade_id)
        ->where('classroom_id', auth()->user()->Classroom_id)
        ->where('section_id', auth()->user()->section_id)
        ->orderBy('id', 'DESC')
        ->get();
    return view('pages.Students.dashboard.exams.index', compact('quizzes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($quizze_id)
    {
        $student_id = Auth::user()->id;
        return view('pages.Students.dashboard.exams.show',compact('quizze_id','student_id'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
