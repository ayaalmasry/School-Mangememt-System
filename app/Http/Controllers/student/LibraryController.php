<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;
use Illuminate\Http\Request;
use App\Models\Library;
use App\Models\Grade;

use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    use AttachFilesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return "1";
        $books = Library::all();
        return view('pages.library.index',compact('books'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $grades = Grade::all();
        return view('pages.library.create',compact('grades'));
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $this->uploadFile($request,'file_name');
             /*$file_name = $request->file('file_name')->getClientOriginalName();
        $request->file('file_name')->storeAs('attachments/library/',$file_name,'upload_attachments');*/
  

            toastr()->success(trans('messages.success'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit',compact('book','grades'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $book = library::findorFail($request->id);
            $book->title = $request->title;

            /*if($request->hasfile('file_name')){

               $exists = Storage::disk('upload_attachments')->exists('attachments/library/'.'file_name');

        if($exists)
        {
            Storage::disk('upload_attachments')->delete('attachments/library/'.'file_name');
        }

                 $file_name = $request->file('file_name')->getClientOriginalName();
        $request->file('file_name')->storeAs('attachments/library/',$file_name,'upload_attachments');*/
            $this->deleteFile($book->file_name);

                $this->uploadFile($request,'file_name');

  
                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            

            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         // Storage::disk('upload_attachments')->delete('attachments/library/'.$request->filename);

        $this->deleteFile($request->file_name);
       
        library::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    

    }
   public function download($filename)
    {
        return response()->download(public_path('attachments/library/'.$filename));
    }
}
