<?php

namespace App\Http\Controllers\TeacherDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Sections;
use App\Models\Attends;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ids= DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id',$ids)->get();
        return view('pages.Teachers.dashboard.students.index',compact('students'));
  
    }
    
    public function sections(){
         $ids= DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('sections_id');
        $sections = Sections::whereIn('id',$ids)->get();
        //return $sections;
        return view('pages.Teachers.dashboard.sections.index',compact('sections'));
  
    }
    
    public function attendance(Request $request){
        try {

            //$attenddate = date('Y-m-d');
            $classid = $request->section_id;
            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attends::create([
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' =>date('Y-m-d') ,
                    'attendence_status' => $attendence_status
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
    }
    public function Editattendance(Request $request){
        
        return $request;
        

       /*try{
           // $date = date('Y-m-d');
            $student_id = Attends::where('attendence_date',$date)->where('student_id',$request->id)->first();
            if( $request->attendences == 'presence' ) {
                $attendence_status = true;
            } else if( $request->attendences == 'absent' ){
                $attendence_status = false;
            }
            $student_id->update([
                'attendence_status'=> $attendence_status
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }*/

    }
    public function attendaceeport(){
        //return "1.";
         $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id', $ids)->get();
        //return $students;
        return view('pages.Teachers.dashboard.students.attendance_report', compact('students'));

       
    }
    
     public function attendanceSearch(Request $request)
    {

       


        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id', $ids)->get();

       
       
 // في حالة عدم تحديد تاريخ
        if ($request->student_id && $request->from =='' && $request->to =='') {
            
           $Students = Attends::select('*')->where('student_id','=',$request->student_id)->get();
            return view('pages.Teachers.dashboard.students.attendance_report', compact('Students', 'students'));
    
           //$type = $request->type;
          // return view('reports.invoices_report',compact('type'))->withDetails($invoices);
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
           
          $start_at = date($request->from);
          $end_at = date($request->to);
          //$type = $request->type;
          
           $Students= Attends::whereBetween('attendence_date',[$start_at,$end_at])->where('student_id','=',$request->student_id)->get();
             return view('pages.Teachers.dashboard.students.attendance_report', compact('Students', 'students'));

          //return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);
          
        }
     }

 


    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
