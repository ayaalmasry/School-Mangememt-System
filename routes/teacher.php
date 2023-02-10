<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher-dashboard', function () {
        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('sections_id');
        $count_sections =  $ids->count();
        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
       
        return view('dashboardteacher',compact('count_sections','count_students'));
    });
        Route::group(['namespace' => 'TeacherDash'], function () {
             Route::resource('Students', 'studentController');
            Route::get('section', 'studentController@sections')->name('section');
            Route::post('attendance','studentController@attendance')->name('attendance');
            Route::get('attendance_report', 'studentController@attendaceeport')->name('attendance_report');
           
            Route::post('attendance.search', 'studentController@attendanceSearch')->name('attendance.search');
            Route::resource('quiz','QuizzController');
            Route::get('/Get_class/{id}','QuizzController@getclass');
            Route::get('/Get_sectin/{id}','QuizzController@getsection');
             Route::resource('ques','qustController');
            Route::resource('zoom','ZoomController');
             Route::get('Indirec','ZoomController@indirectCreate')->name('Indirec.create');
             Route::post('Indirec','ZoomController@storeIndirect')->name('Indirec.store');
             Route::get('profile','profileController@index')->name('profile.show');
            Route::post('profile/{id}','profileController@update')->name('profile.update');
           Route::get('student_quizze/{id}','QuizzController@student_quizze')->name('student_quizze');
           Route::post('repeat_quizze/{id}','QuizzController@repeat_quizze')->name('repeat.quizze');
        
     
             
               
           
           
           
              
            
            
        });

});