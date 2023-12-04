<?php

namespace App\Http\Controllers;

use App\Models\Pormotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grade;
use App\Models\Student;

class PormotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index',compact('Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $promotions = Pormotion::all();
        return view('pages.Students.promotion.management',compact('promotions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',   $request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();
            if($students->count() < 1){
                return redirect()->back()->with('error', trans('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student){

                $ids = explode(',',$student->id);
                Student::whereIn('id', $ids)
                    ->update([
                        'Grade_id'=>$request->Grade_id_new,
                        'Classroom_id'=>$request->Classroom_id_new,
                        'section_id'=>$request->section_id_new,
                        'academic_year'=>$request->academic_year_new,
                    ]);

                // insert in to promotions
                Pormotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_Classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_Classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);

            }
            DB::commit();
            return redirect()->back()->with('success', trans('all_trans.Success'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pormotion $pormotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pormotion $pormotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pormotion $pormotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            // التراجع عن الكل
            if($request->page_id ==1){
                $promotions = Pormotion::all();
                foreach ($promotions as $promotion){
                    //التحديث في جدول الطلاب
                    $ids = explode(',',$promotion->student_id);
                    Student::whereIn('id', $ids)
                    ->update([
                        'Grade_id'=>$promotion->from_grade,
                        'Classroom_id'=>$promotion->from_classroom,
                        'section_id'=>$promotion->from_section,
                        'academic_year'=>$promotion->academic_year,
                ]);
                //حذف جدول الترقيات
                Pormotion::truncate();
            }
            DB::commit();
            return redirect()->back()->with('error', trans('all_trans.done_delete'));
            }
            else
            {
                $promotions = Pormotion::findorfail($request->id);
                Student::where('id', $promotions->student_id)
                    ->update([
                        'Grade_id'=>$promotions->from_grade,
                        'Classroom_id'=>$promotions->from_classroom,
                        'section_id'=>$promotions->from_section,
                        'academic_year'=>$promotions->academic_year,
                ]);
                Pormotion::destroy($request->id);
                DB::commit();
                return redirect()->back()->with('error', trans('all_trans.done_delete'));
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
