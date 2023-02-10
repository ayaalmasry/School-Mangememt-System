<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\My_Parent12;
use App\Models\Blood;
use App\Models\Gender;
use App\Models\Nationality;
use Illuminate\Support\Facades\Hash;
use App\Models\Classroom;
use App\Models\Sections;
use App\Models\Student;
use App\Models\Image;
class StudentRepository implements StudentRepositoryInterface{


    public function Create_Student(){

       $data['my_classes'] = Grade::all();
       $data['parents'] = My_Parent12::all();
       $data['Genders'] = Gender::all();
       $data['nationals'] = Nationality::all();
       $data['bloods'] = Blood::all();
       return view('pages.student.add',$data);

    }
    public function Get_classrooms($id){

        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;

    }
    public function Get_Sections($id){
        $list_classes = Sections::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_classes;

    }
    
    public function Get_Students(){
        $students=Student::all();
        return view('pages.student.index',compact('students'));
    }
     public function edit_Students($id){
         $data['Grades'] = Grade::all();
       $data['parents'] = My_Parent12::all();
       $data['Genders'] = Gender::all();
       $data['nationals'] = Nationality::all();
       $data['bloods'] = Blood::all();
        $Students=Student::findOrFail($id);
       return view('pages.student.edit',$data,compact('Students'));

         
     }
     public function update_Students($request){
         try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->password = Hash::make($request->password);
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Student.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
     }
    
     public function delete_Students($request){
          Student::findorfail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
            return redirect()->route('Student.index');
        
     }
    
     public function show_Students($id){
          $Student = Student::findorfail($id);
         //return $Student;
           
          return view('pages.student.show',compact('Student'));
         
     }
     public function  Upload_attachment($request){
        // return $request ;
         
         foreach($request->file('photos') as $file){
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/student/'.$request->student_name,$file->getClientOriginalName(),'upload_attachments');
             
                    $image=new Image();
                    $image->filename=$name;
                    $image->imageable_id=$request->student_id;
                    $image->imageable_type='App\Models\Student';
                    $image->save();
             toastr()->success(trans('messages.success'));
            return redirect()->route('Student.show',$request->student_id);
      
                    
                    
                }
         
                    
                }
     
  
    
    
    
    
   


}