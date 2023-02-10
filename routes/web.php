<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes/web.php
//Auth::routes();



Route::get('/', function(){
    return view('auth.selection');
})->name('selection');




    
    
    /* Route::get('/login/{type}',function($type){
         return view('auth.login',compact('type'));
     })->name('loginform');*/

 Route::get('/login/{type}','Auth\CustomerAuthController@loginForm')
        
    ->name('loginform');


Route::post('/login','Auth\CustomerAuthController@login')->name('login');
Route::get('/logout/{type}', 'Auth\CustomerAuthController@logout')->name('logout');
    


  
   
    /*Route::post('/login',function(Request $request){
        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
           return $this->redirect($request);
        }
    })->name('login');*/





//Route::get('/dashboard', 'HomeController@indedashboard')->name('dashboard');

//==============================Translate all pages============================

 
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth']
], function(){ 
    
    
     //==============================dashboard============================
     Route::get('dashboard', 'Auth\CustomerAuthController@dashboard')->name('dashboard');

    
    // Route::get('student-dashboard', 'Auth\CustomerAuthController@student')->middleware('auth:student')->name('student');
    
    //Route::get('student-dashboard', 'Auth\CustomerAuthController@teacher')->middleware('auth:teacher')->name('teacher');


    
   Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });
   //==============================Classrooms============================
    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all','ClassroomController@delete_all')->name('delete_all');
        Route::post('Filter_Classes','ClassroomController@Filter_Classes')->name('Filter_Classes');
         });
     //==============================Sections============================
 
        Route::group(['namespace' => 'sections'], function () {
             Route::resource('Sections', 'SectionsController');
            Route::get('/classes/{id}','SectionsController@getclasses');
       
        });
     //==============================Parents============================
    Route::view('add_parent','livewire.Show_Form')->name('add_parent');
    //==============================Teachers============================
    Route::group(['namespace' => 'Teachers'], function () {
             Route::resource('Teachers', 'TeacherController');
            
        });
    //==============================student============================
     Route::group(['namespace' => 'student'], function () {
             Route::resource('Student', 'StudentController');
         
             Route::resource('online_classes', 'OnlineClassesController');
             Route::resource('library', 'LibraryController');
       Route::get('download_file/{filename}','LibraryController@download')->name('downloadAttachment');
       
        Route::get('indirect','OnlineClassesController@indirectCreate')->name('indirect.create');
          Route::post('indirect','OnlineClassesController@storeIndirect')->name('indirect.store');
       
           
        Route::resource ('Graduate','GraduationController' );
        Route::get('Get_classrooms/{id}','StudentController@Get_classroom');
        Route::get('Get_Sections/{id}','StudentController@Get_Sections');
        Route::post('Upload_attachment','StudentController@upload')->name('Upload_attachment');
        Route::get('Download_attachment/{studentname}/{filename}','StudentController@Download')->name('Download_attachment');
        Route::post('Delete_attachment','StudentController@Delete')->name('Delete_attachment'); 
       
       
            
        });
    //==============================promotion student============================
     Route::group(['namespace' => 'student'], function () {
             Route::resource('Promotion', 'promotionController');
             Route::resource('Fees', 'FeesController');
             Route::resource('Fees_Invoices', 'FeesInvoicesController'); 
            Route::resource('receipt_students', 'ReceiptStudentController');
            Route::resource('ProcessingFee', 'ProcessingFeesController');
            Route::resource('Payment_students', 'PayementStudents');
            Route::resource('Attendance', 'AttendsController');
          
            
     });
    
     //==============================subjects============================
    
     Route::group(['namespace' => 'Subjects'], function () {
             Route::resource('subjects', 'SubjectsController');
             
            
     });
  
         
         //==============================Fees============================
     Route::group(['namespace' => 'Quizz'], function () {
             Route::resource('Quizzes', 'QuizzController');
             
            
     });
  
    //==============================Qustions============================
     Route::group(['namespace' => 'Question'], function () {
             Route::resource('questions', 'QuestionController');
             
            
     }); 
    //==============================SettingController============================
   
   Route::resource('settings', 'SettingController');
//Livewire::component('calendar', Calendar::class);
            
  
   
  
  
 
    


   
});




