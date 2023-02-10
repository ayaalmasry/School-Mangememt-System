<?php


namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreStudentsRequest;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudnet;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentRepositoryInterface $Student){
        $this->Student=$Student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->Student->Get_Students();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return $this->Student->create_student();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try{
            
        
    
        
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            if($request->hasfile('photo')){
                foreach($request->file('photo') as $file){
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/student/'.$students->name,$file->getClientOriginalName(),'upload_attachments');
                    $image=new Image();
                    $image->filename=$name;
                    $image->imageable_id=$students->id;
                    $image->imageable_type='App\Models\Student';
                    $image->save();
                    
                    
                }
            }
            
           DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Student.create');
             
        }catch(\Exception $ex){
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        
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
          return $this->Student->show_Students($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return $this->Student->edit_Students($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStudnet $request, $id)
    {
         return $this->Student->update_Students($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       return $this->Student->delete_Students($request);
    }
    public function Get_classroom($id){
        
         return $this->Student->Get_classrooms($id);
    }
    public function Get_Sections($id){
        return $this->Student->Get_Sections($id);
        
    }
    public function upload(Request $request){
        return $this->Student->Upload_attachment($request);
    }
    public function Download($studentname,$filename){
        return response()->download(public_path('attachments/student/'.$studentname.'/'.$filename));
  
    }
    public function Delete(Request $request){
        //return $request;
        Storage::disk('upload_attachments')->delete('attachments/student/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        Image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Student.show',$request->student_id);
  
        
    }
}
