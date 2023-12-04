<?php

namespace App\Http\Controllers;
use App\Models\Online;
use App\Models\Grade;
use Illuminate\Http\Request;

class OnlineTeacherController extends Controller
{
    public function index()
    {
        $online_classes = Online::where('created_by',auth()->user()->email)->get();
        return view('pages.teachers.dashboard.online_classes.index', compact('online_classes'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.teachers.dashboard.online_classes.indirect', compact('Grades'));
    }

    public function store(Request $request)
    {
        Online::create([
            'integration' => false,
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'created_by' => auth()->user()->email,
            'meeting_id' => $request->meeting_id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url,
        ]);
        return redirect()->route('online_zoom.index')->with('success', trans('all_trans.Success'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        try {
            $info = Online::find($request->id);
            if($info->integration == true){
                $meeting = Zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
                Online::destroy($request->id);
            }
            else{
                Online::destroy($request->id);
            }
            return redirect()->route('online_zoom.index')->with('error', trans('all_trans.done_delete'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
