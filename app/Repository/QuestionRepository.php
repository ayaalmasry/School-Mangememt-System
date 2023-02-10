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
use App\Models\Quession;
class QuestionRepository implements QuestionRepositoryInterface{
   public function show($id){
          
       }
    public function index(){
        //return "123";
        $questions = Quession::get();
        return view('pages.Questions.index', compact('questions'));
    
        }
     public function store($request){
         try {
            $question = new Quession();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizze_id;
            $question->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
     }
     public function edit($id){
        $question = Quession::findorfail($id);
        $quizzes = Quizz::get();
        return view('pages.Questions.edit',compact('question','quizzes'));
  
        
        }
     public function update($request){
          try {
            $question = Quession::findorfail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizze_id;
            $question->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
       

     }
    public function destroy($request){
         try {
            Quession::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
        
    
    public function create(){
        $quizzes = Quizz::get();
        return view('pages.Questions.create',compact('quizzes'));
    
                 

    }
    

   



}