<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;

use App\Models\Sections;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Http\Requests\storeSection;


class SectionsController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      
      $Grades=Grade::with(['Sections'])->get();
      $List=Grade::all();
      $Teachers=Teacher::all();
     
      //dd($Grades);
    return view('pages.Sections.section',compact('Grades','List','Teachers'));
 
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
  public function store(storeSection $request)
  {
      
      //return  $request->teacher_id;
      try{
            $validated = $request->validated();
          
          $Section= new Sections();
           $Section->Name_Section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
        
          $Section->Grade_id=$request->Grade_id;
         
           $Section->Class_id = $request->Class_id;
         
          $Section->Status = 1;
          
          $Section->save();
          $Section->teachers()->attach($request->teacher_id);
     
        toastr()->success(trans('messages.success'));
          return redirect()->route('Sections.index');
          
        
                                      
          
      } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
  public function update(storeSection $request)
  {
    try{
            $validated = $request->validated();
          
          $Section= Sections::findOrFail($request->id);
           $Section->Name_Section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
        
          $Section->Grade_id=$request->Grade_id;
         
           $Section->Class_id = $request->Class_id;
        if(isset($request->Status)) {
        $Section->Status = 1;
      } else {
        $Section->Status = 2;
      }
         //updateTable
        if(isset($request->teacher_id)){
            $Section->teachers()->sync($request->teacher_id);
        }else{
            $Section->teachers()->sync(array());
        }
         
          $Section->save();
          toastr()->success(trans('message.success'));
          return redirect()->route('Sections.index');
          
        
                                      
          
      } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(request $request)
  {
    Sections::findOrFail($request->id)->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('Sections.index');

  }
   public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
    }
  
}

?>