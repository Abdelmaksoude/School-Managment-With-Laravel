<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;

class GradutedStudentController extends Controller
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Students.Graduated.create',compact('Grades'));
    }

    public function store(Request $request)
    {
        $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error', trans('لاتوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student){
            $ids = explode(',',$student->id);
            Student::whereIn('id', $ids)->Delete();
        }

        return redirect()->route('Graduated.index')->with('error', trans('all_trans.done_delete'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Request $request)
    {
        Student::findOrFail($request->id)->delete();
        return redirect()->route('Graduated.index')->with('error', trans('all_trans.done_delete'));
    }

    public function update(Request $request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->restore();
        return redirect()->back()->with('success', trans('all_trans.Success'));
    }

    public function destroy(Request $request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        return redirect()->back()->with('error', trans('all_trans.done_delete'));
    }
}
