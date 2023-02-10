<?php

namespace App\Repository;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
class  TeacherRepository implements TeacherRepositoryInterface{
    public function getAllTeacher(){
         return  Teacher::all();
     }
    public function storeTeachers($request){
        try{
            $Teachers = new Teacher();
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teachers.create');
      
            
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => $ex->getMessage()]);
    
        }
    }
    public function editTeachers($id){
        return Teacher::findOrFail($id);
        
    }
    
    public function updateTeachers($request){
         try{
            $Teachers =Teacher::findOrFail($request->id);
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.update'));
            return redirect()->route('Teachers.create');
      
            
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => $ex->getMessage()]);
    
        }
    }
     public function deleteTeachers($request){
        Teacher::findOrFail($request->id)->delete();
         
         toastr()->error(trans('messages.Delete'));
        return redirect()->route('Teachers.index');
      
     }
}