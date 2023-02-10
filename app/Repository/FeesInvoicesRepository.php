<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\promotions;
use App\Models\Fee;
use App\Models\Fees_invoices;
use App\Models\StudentAccount;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface{
   public function show($id){
       $student=Student::findOrFail($id);
       $fees=Fee::where('Classroom_id',$student->Classroom_id)->get();
       return view('pages.Fees_Invoices.add',compact('student','fees'));
   }
    public function index(){
        $Fee_invoices =Fees_invoices::all();
        $Grades = Grade::all();
        return view('pages.Fees_Invoices.index',compact('Fee_invoices','Grades'));
    
    }
     public function store($request){
         //return $request;
          $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new Fees_invoices();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->Grade_id = $request->Grade_id;
                $Fees->Classroom_id = $request->Classroom_id;;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();


                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new StudentAccount();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = 'invoice';
               
               
                $StudentAccount->fee_invoice_id = $Fees->id;
                $StudentAccount->student_id = $List_Fee['student_id'];
                $StudentAccount->Debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
     }
     public function edit($id){
         $fee_invoices=Fees_invoices::findOrFail($id);
         $fees=Fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
          return view('pages.Fees_Invoices.edit',compact('fee_invoices','fees'));
    
         
     }
     public function update($request){
         DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = Fees_invoices::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::findorfail($request->id);
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

     }
    public function destroy($request)
    {
        try {
            Fees_invoices::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

   



}