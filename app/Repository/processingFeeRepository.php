<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\promotions;
use App\Models\Fee;
use App\Models\Fees_invoices;
use App\Models\StudentAccount;
use App\Models\ProcessingFees;

class processingFeeRepository implements processingFeeRepositoryInterface{
     public function index(){
         $ProcessingFees=ProcessingFees::all();
         return view('pages.Processing.index',compact('ProcessingFees'));
             }
     public function show($id){
         $student=Student::findOrFail($id);
         return view('pages.Processing.add',compact('student'));
        
         
     }
    public function store($request){
        DB::beginTransaction();
        try{
            $ProcessingFee = new ProcessingFees();
            $ProcessingFee->date=date('Y-m-d');
            $ProcessingFee->amount=$request->amount;
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();
            
            
            $students_accounts = new StudentAccount();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id=$request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ProcessingFee.index');
       


        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    public function edit($id){
        $ProcessingFee=ProcessingFees::findOrFail($id);
        return view('pages.Processing.edit',compact('ProcessingFee'));
     
        
    }
    public function update($request){
        DB::beginTransaction();
        try{
            $ProcessingFee = ProcessingFees::findOrFail($request->id);
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();
            
            
            $students_accounts = StudentAccount::where('processing_id',$request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('ProcessingFee.index');
       


        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            ProcessingFees::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
 



}