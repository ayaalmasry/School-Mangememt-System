<?php

namespace App\Http\Controllers\TeacherDash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\onlineclasses;
use App\Models\Grade;

class ZoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return "123";
        $online_classes = onlineclasses::all();
        return view('pages.Teachers.dashboard.zoom.index', compact('online_classes'));
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function indirectCreate(){
        $Grades = Grade::all();
        return view('pages.Teachers.dashboard.zoom.indirect', compact('Grades'));
   
    }
   public function storeIndirect(Request $request){
        
        
            onlineclasses::create([
                'integration' => false,
                
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' =>3,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('zoom.index');
        
    }
    public function destroy(Request $request)
    {
         try {
              onlineclasses::where('meeting_id', $request->id)->delete();
            //$meeting = Zoom::meeting()->find($request->id);
            //$meeting->delete();
            onlineclasses::where('meeting_id', $request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('zoom.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
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
}