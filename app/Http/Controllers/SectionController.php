<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Grade;
use App\Models\ClassRoom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::with(['sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.sections.sections',compact('Grades','list_Grades','teachers'));
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
        try {
            $Sections = new Section();
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->grade_id = $request->Grade_id;
            $Sections->class_id = $request->Class_id;
            $Sections->Status = 1;
            $Sections->save();
            $Sections->teachers()->attach($request->teacher_id);
            return redirect()->route('section.index')->with('success', trans('all_trans.Success'));
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        try {
            $Sections = Section::findOrFail($request->id);
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->grade_id = $request->Grade_id;
            $Sections->class_id = $request->Class_id;
            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }
            // update pivot tABLE
            if (isset($request->teacher_id)) {
                $Sections->teachers()->sync($request->teacher_id);
            } else {
                $Sections->teachers()->sync(array());
            }
            $Sections->save();
            return redirect()->route('section.index')->with('success', trans('all_trans.Update'));
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        return redirect()->route('section.index')->with('error', trans('all_trans.done_delete'));
    }

    public function getclasses($id)
    {
        $list_classes = ClassRoom::where("grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;
    }
}
