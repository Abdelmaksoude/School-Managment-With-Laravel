<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.grades' , compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en',$request->Name_en)->exists()) {
            return redirect()->back()->withErrors(trans('all_trans.exists'));
        }
        $validated = $request->validate([
            'Name' => 'required',
            'Notes' => 'required',
        ]);
        $Grade = new Grade();
        /*
        $translations = [
            'en' => $request->Name_en,
            'ar' => $request->Name
        ];
        $Grade->setTranslations('Name', $translations);
        */
        $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
        $Grade->Notes = ['en' => $request->Notes_en, 'ar' => $request->Notes];
        $Grade->save();
        // toastr()->success(trans('all_trans.Success'));
        return redirect()->route('grade.index')->with('success', trans('all_trans.Success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $grade = Grade::findOrFail($request->id);
        $grade->setTranslations('Name', [
            'en' => $request->Name_en,
            'ar' => $request->Name
        ]);
        $grade->setTranslations('Notes', [
            'en' => $request->Notes_en,
            'ar' => $request->Notes
        ]);
        $grade->save();
        return redirect()->route('grade.index')->with('success', trans('all_trans.Update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $MyClass_id = ClassRoom::where('grade_id',$request->id)->pluck('grade_id');
        if($MyClass_id->count() == 0){
            $Grades = Grade::findOrFail($request->id)->delete();
            return redirect()->route('grade.index')->with('success', trans('all_trans.done_delete'));
        }
        else{
            return redirect()->route('grade.index')->with('error', trans('all_trans.Warning'));
        }
    }
}
