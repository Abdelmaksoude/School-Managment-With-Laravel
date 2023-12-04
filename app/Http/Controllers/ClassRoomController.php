<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $My_Classes = ClassRoom::all();
        $Grades = Grade::all();
        return view('pages.classes.My_Classes',compact('My_Classes','Grades'));
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
        $validated = $request->validate([
            'List_Classes.*.Name' => 'required',
            'List_Classes.*.Name_class_en' => 'required',
        ]);
        $List_Classes = $request->List_Classes;
        try {
            foreach ($List_Classes as $List_Class) {
                $My_Classes = new ClassRoom();
                $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
                $My_Classes->grade_id = $List_Class['Grade_id'];
                $My_Classes->save();
            }
            return redirect()->route('classes.index')->with('success', trans('all_trans.Success'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        try {
            $Classrooms = ClassRoom::findOrFail($request->id);
            $Classrooms->update([
                $Classrooms->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Classrooms->grade_id = $request->Grade_id,
            ]);
            return redirect()->route('classes.index')->with('success', trans('all_trans.Success'));
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
        $Classrooms = ClassRoom::findOrFail($request->id)->delete();
        return redirect()->route('classes.index');
    }

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);
        ClassRoom::whereIn('id', $delete_all_id)->Delete();
        return redirect()->route('classes.index')->with('success', trans('all_trans.done_delete'));
    }

    public function filter(Request $request)
    {
        $Grades = Grade::all();
        $Search = ClassRoom::select('*')->where('grade_id','=',$request->Grade_id)->get();
        $My_Classes = $Search;
        return view('pages.classes.My_Classes',compact('Grades','My_Classes'))->withDetails($Search);
    }
}
