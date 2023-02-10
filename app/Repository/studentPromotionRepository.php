<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\promotions;

class studentPromotionRepository implements studentPromotionRepositoryInterface{


   public function index(){
      $Grades=Grade::all();
       return view('pages.student.promotion.index',compact('Grades'));
   }
    public function store($request){
       // return $request;
        DB::beginTransaction();
        try{
            
        
       
            $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();
            if($students ->count() < 1){
                return redirect()->back()->with('error_promotions',__('لاتوجد بيانات في جدول الطلاب'));
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
                
                promotions::updateOrCreate([
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
            
            toastr()->success(trans('messages.success'));
            return redirect()->back();
             }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->withErrors(['error'=>$ex->getMessage()]);
        }
    }
    public function create(){
        $promotions=promotions::all();
         return view('pages.student.promotion.create',compact('promotions'));
  
    }
    public function destroy($request){
        
        
        
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request->page_id ==1){

             $Promotions = promotions::all();
             foreach ($Promotions as $Promotion){

                 //التحديث في جدول الطلاب
                 $ids = explode(',',$Promotion->student_id);
                 student::whereIn('id', $ids)
                 ->update([
                 'Grade_id'=>$Promotion->from_grade,
                 'Classroom_id'=>$Promotion->from_Classroom,
                 'section_id'=> $Promotion->from_section,
                 'academic_year'=>$Promotion->academic_year,
               ]);

                 //حذف جدول الترقيات
                 promotions::truncate();

             }
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

            else{
                $Promotion = promotions::findOrFail($request->id);
                
                //return $request;
                 student::where('id', $Promotion->student_id)->update([
                      'Grade_id'=>$Promotion->from_grade,
                      'Classroom_id'=>$Promotion->from_Classroom,
                     'section_id'=> $Promotion->from_section,
                     'academic_year'=>$Promotion->academic_year,
           
                 ]);
                promotions::destroy($request->id);
               
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

             
                

               
            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
      
    }

    




}