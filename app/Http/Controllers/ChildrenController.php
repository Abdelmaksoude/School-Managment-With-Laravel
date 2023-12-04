<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Degree;
use App\Models\FeeInvoices;
use App\Models\ReceiptStudent;
use App\Models\MyParent;
use App\Models\AttendanceStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    public function index()
    {
        $students = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.children.index', compact('students'));
    }

    public function results($id)
    {
        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id)
        {
            return redirect()->route('sons.index')->with('error','يوجد خطا في كود الطالب');
        }

        $degrees = Degree::where('student_id',$student->id)->get();

        if ($degrees->isEmpty())
        {
            return redirect()->route('sons.index')->with('error','لا توجد نتائج لهذا الطالب');
        }

        return view('pages.parents.degrees.index', compact('degrees'));
    }

    public function attendaces()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parents.attendancess.index', compact('students'));
    }

    public function attendacesSearch(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        if ($request->student_id == 0) {
            $Students = AttendanceStudent::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.parents.attendancess.index', compact('Students', 'students'));
        } else {
            $Students = AttendanceStudent::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.parents.attendancess.index', compact('Students', 'students'));
        }
    }

    public function fee()
    {
        $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $Fee_invoices = FeeInvoices::whereIn('student_id',$students_ids)->get();
        return view('pages.parents.fees.index', compact('Fee_invoices'));
    }

    public function recipt($id)
    {
        $student = Student::findorFail($id);
        if ($student->parent_id !== auth()->user()->id) {
            return redirect()->route('sons.fee')->with('error','يوجد خطا في كود الطالب');
        }

        $receipt_students = ReceiptStudent::where('student_id',$id)->get();

        if ($receipt_students->isEmpty()) {
            return redirect()->route('sons.fee')->with('error','لا توجد نتائج لهذا الطالب');
        }
        return view('pages.parents.recipts.index', compact('receipt_students'));
    }

    public function profile()
    {
        $information = MyParent::findorFail(auth()->user()->id);
        return view('pages.parents.profile', compact('information'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $information = MyParent::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        return redirect()->back()->with('success', trans('all_trans.Update'));

    }
}
