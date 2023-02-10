<?php 
namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\StoreGrade ;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use Illuminate\Http\Request;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $Grades=Grade::all();
    return view('pages.Grades.Grades',compact('Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreGrade  $request)
      
  {
      if(Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){
          return redirect()->back()->withErrors(trans('Grades_trans.exists'));
      }
      try{
          
      $validated = $request->validated();
       $Grade = new Grade();
          
          $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
          $Grade->Notes = $request->Notes;
          $Grade->save();
          toastr()->success(trans('messages.success'));
          return redirect()->route('Grades.index');
         }catch(\Exception $e){
          return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
          
      }
    
 
  }

    
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreGrade $request)
  {
      //return $request;
       try {

       $validated = $request->validated();
       $Grades = Grade::findOrFail($request->id);
       $Grades->update([
         $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
         $Grades->Notes = $request->Notes,
       ]);
       toastr()->success(trans('messages.update'));
       return redirect()->route('Grades.index');
   }
   catch
   (\Exception $e) {
       return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }
          
          
     
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
       $MY_Class=Classroom::where('Grade_id',$request->id)->pluck('Grade_id');
      if($MY_Class->count()==0){
          $Grades = Grade::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('Grades.index');
 
      }    

      else{
           toastr()->error(trans('Grades_trans.delete_Grade_Error'));
            return redirect()->route('Grades.index');
   
      }
  
        
  }
  
}

?>