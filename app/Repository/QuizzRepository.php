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
use App\Models\Quizz;
use App\Models\Subjects;
class QuizzRepository implements QuizzRepositoryInterface{
   public function show($id){
          
       }
    public function index(){
           $quizzes = Quizz::get();
        return view('pages.Quizzes.index', compact('quizzes'));
   
    }
     public function store($request){
         try {

            $quizzes = new Quizz();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Quizzes.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
     }
     public function edit($id){
        
         $quizz = Quizz::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subjects::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.edit', $data, compact('quizz'));
   
     }
     public function update($request){
        try {
            $quizz = Quizz::findorFail($request->id);
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

     }
    public function destroy($request)
    {
        try {
            Quizz::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
    }
    public function create(){
        $data['grades'] = Grade::all();
        $data['subjects'] = Subjects::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.create', $data);
   
                

    }
    

   



}