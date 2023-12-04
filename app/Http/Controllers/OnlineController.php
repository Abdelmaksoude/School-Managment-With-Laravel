<?php

namespace App\Http\Controllers;

use App\Models\Online;
use App\Models\Grade;
use App\Http\Traits\MeetingZoomTrait;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Http\Request;

class OnlineController extends Controller
{
    use MeetingZoomTrait;
    public function index()
    {
        $online_classes = Online::where('created_by',auth()->user()->email)->get();
        return view('pages.online_classes.index', compact('online_classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact('Grades'));
    }
    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.indirect', compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $meeting = $this->createMeeting($request);
            Online::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            return redirect()->route('online_classes.index')->with('success', trans('all_trans.Success'));
    }
    public function storeIndirect(Request $request)
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
            return redirect()->route('online_classes.index')->with('success', trans('all_trans.Success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Online $online)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Online $online)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Online $online)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
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
            return redirect()->route('online_classes.index')->with('error', trans('all_trans.done_delete'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
