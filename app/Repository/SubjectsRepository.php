<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\promotions;
use App\Models\Fee;
use App\Models\Fees_invoices;
use App\Models\StudentAccount;
use App\Models\Teacher;
use App\Models\Attends;
use App\Models\Subjects;
class SubjectsRepository implements SubjectsRepositoryInterface{
   public function show($id){
          
       }
    public function index(){
        $subjects=Subjects::all();
         return view('pages.Subjects.index',compact('subjects'));
        
    }
    public function create(){
        //$subjects=Subjects::all();
        $grades=Grade::all();
         $teachers=Teacher::all();
         return view('pages.Subjects.create',compact('grades','teachers'));
        
    }
     public function store($request){
        try {
            $subjects = new Subjects();
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('subjects.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
     }
     public function edit($id){
        $subject=Subjects::findOrFail($id);
         $grades=Grade::all();
         
        $teachers = Teacher::get();
       
       
         return view('pages.Subjects.edit',compact('subject','grades','teachers'));
        
         
     }
     public function update($request){
        try {
            $subjects =  Subjects::findorfail($request->id);
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('subjects.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

     }
    public function destroy($request)
    {
        try {
            Subjects::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

   



}