<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\promotions;

class StudentGraduateRepository implements StudentGraduateRepositoryInterface{


   public function index(){
       $students=Student::onlyTrashed()->get();
       return view('pages.student.Graduate.index',compact('students'));
   }
    public function create(){
        //echo "123";
        $Grades=Grade::all();
        return view('pages.student.Graduate.create',compact('Grades'));
    }
    public function store($request){
        //return $request;
        $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
         if($students ->count() < 1){
                return redirect()->back()->with('error_promotions',__('لاتوجد بيانات في جدول الطلاب'));
            }
        //return $students;
        foreach ($students as $student){

                $ids = explode(',',$student->id);
                Student::whereIn('id', $ids)->Delete();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Graduate.index');
            
                    

    }
    }
        public function update($request)
        {
            Student::onlyTrashed()->where('id',$request->id)->first()->restore();
             toastr()->success(trans('messages.success'));
             return redirect()->back();
            
        }
    public function destroy($request){
        Student::onlyTrashed()->where('id',$request->id)->first()->forceDelete();
             toastr()->error(trans('messages.Delete'));
             return redirect()->back();
          
    }

   





}