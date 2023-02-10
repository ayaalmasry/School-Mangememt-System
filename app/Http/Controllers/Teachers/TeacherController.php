<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\specializations;
use App\Models\Gender;
use App\Http\Requests\StoreTeachers;
 use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $Teacher;
    
    public function __construct(TeacherRepositoryInterface $Teacher){
        $this->Teacher = $Teacher;
    }
    public function index()
    {
        $Teachers=$this->Teacher->getAllTeacher();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializations=specializations::all();
        $genders=Gender::all();
        return view('pages.Teachers.create',compact('specializations','genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeachers $request)
    {
        return $this->Teacher->storeTeachers($request);
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
        $Teachers= $this->Teacher->editTeachers($id);
        $specializations=specializations::all();
        $genders=Gender::all();
       
        return view('pages.Teachers.edit',compact('specializations','genders','Teachers'));
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTeachers $request)
    {
        return $this->Teacher->updateTeachers($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         return $this->Teacher->deleteTeachers($request);
    }
}
