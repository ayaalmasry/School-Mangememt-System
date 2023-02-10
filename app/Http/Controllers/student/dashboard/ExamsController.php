<?php

namespace App\Http\Controllers\student\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quizz;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return "ooo";
        $quizzes=Quizz::where('grade_id',auth()->user()->Grade_id)->where('section_id',auth()->user()->section_id)->orderBy('id','DESC')->get();
           
           // ->get();
       // return $quizzes;
        return view('pages.student.exams.index',compact('quizzes'));
 
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
    public function show($quizze_id)
    {
        //return "oo";
        $student_id = Auth()->user()->id;
    //return $student_id;
        return view('pages.student.exams.show',compact('quizze_id','student_id'));
 
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
