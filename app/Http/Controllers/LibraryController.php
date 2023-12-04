<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Grade;
use App\Http\Traits\AttachFilesTrait;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();
        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create', compact('grades'));
    }

    public function store(Request $request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
            $this->uploadFile($request,'file_name','library');
            return redirect()->route('library.create')->with('success', trans('all_trans.Success'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show(Library $library)
    {
        //
    }

    public function edit($id)
    {
        $book = Library::findorFail($id);
        $grades = Grade::all();
        return view('pages.library.edit',compact('book','grades'));
    }

    public function update(Request $request)
    {
        try {
            $book = Library::findorFail($request->id);
            $book->title = $request->title;
            if($request->hasfile('file_name')){
                $this->deleteFile($book->file_name);
                $this->uploadFile($request,'file_name','library');
                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }
            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            return redirect()->route('library.index')->with('success', trans('all_trans.Update'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $this->deleteFile($request->file_name);
        Library::destroy($request->id);
        return redirect()->route('library.index')->with('error', trans('all_trans.done_delete'));
    }
    public function downloadAttachment($filename)
    {
        return response()->download(public_path('attachments/library/'.$filename));
    }
}
