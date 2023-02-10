<?php

namespace App\Http\Controllers\parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Degree;
use Illuminate\Support\Facades\DB;
use App\Models\Attends;
use App\Models\Fees_invoices;
use App\Models\ReceiptStudent;
use App\Models\My_Parent12;
class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return "888";
        $students=Student::where('parent_id',auth()->user()->id)->get();
        //return $sons;
        return view('pages.parent.index',compact('students'));
    }
    public function results($id)
    {

        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error('يوجد خطا في كود الطالب');
            return redirect()->route('sons.index');
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            toastr()->error('لا توجد نتائج لهذا الطالب');
            return redirect()->route('sons.index');
        }

        return view('pages.parent.degreeindex', compact('degrees'));

    }
    public function attendacchild(){
        //return "jfj";
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parent.Attendanceindex', compact('students'));
  
    }
    public function attendaceseaarch(Request $request){
               
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id', $ids)->get();

       
       
 // في حالة عدم تحديد تاريخ
        if ($request->student_id && $request->from =='' && $request->to =='') {
            
           $Students = Attends::select('*')->where('student_id','=',$request->student_id)->get();
            return view('pages.parent.Attendanceindex', compact('Students', 'students'));
    
           //$type = $request->type;
          // return view('reports.invoices_report',compact('type'))->withDetails($invoices);
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
           
          $start_at = date($request->from);
          $end_at = date($request->to);
          //$type = $request->type;
          
           $Students= Attends::whereBetween('attendence_date',[$start_at,$end_at])->where('student_id','=',$request->student_id)->get();
             return view('pages.parent.Attendanceindex', compact('Students', 'students'));

          //return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);
          
        }

        
    }
    
    public function feesparent(){
       // return "120";
        $students_ids=Student::where('parent_id',auth()->user()->id)->pluck('id');
       //return $students_ids;
        $Fee_invoices=Fees_invoices::whereIn('student_id',$students_ids)->get();
       // return $Fee_invoices;
        return view('pages.parent.FeesIndex',compact('Fee_invoices'));
    }
    public function receiptstudent($id){
        //return $id;
        $student=Student::findOrFail($id);
        if($student->parent_id !==auth()->user()->id){
            toastr()->error('يوجد خطا بكتابة الكود');
            return redirect()->route('sons.index');
        }
        $receipt_students=ReceiptStudent::where('student_id',$id)->get();
        return view('pages.parent.REceipt',compact('receipt_students'));
    }
    
    public function profile()
    {
        $information = My_Parent12::findorFail(auth()->user()->id);
        return view('pages.parent.profile', compact('information'));
    }
    public function update(Request $request, $id)
    {

        $information = My_Parent12::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.Update'));
        return redirect()->back();


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
