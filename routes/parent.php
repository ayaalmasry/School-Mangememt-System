<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent-dashboard', function () {
        $sons=Student::where('parent_id',auth()->user()->id)->get();
        return view('dashboardparent',compact('sons'));
    });
        
        Route::group(['namespace'=>'parent'],function(){
            Route::resource('sons','ParentController');
            Route::get('results/{id}','ParentController@results')->name('sons.results');
            Route::get('attendanceschild','ParentController@attendacchild')->name('sons.attendanceschild');
            Route::post('attendanceschild','ParentController@attendaceseaarch')->name('sons.attendanceschild.search');
            Route::get('feesparent','ParentController@feesparent')->name('sons.feesparent');
            Route::get('receipt/{id}','ParentController@receiptstudent')->name('sons.receipt');
            Route::get('profileparent','ParentController@profile')->name('profileparent.show');
           Route::post('profileparent/{id}','ParentController@update')->name('profileparent.update');
           
          
              });

        
});