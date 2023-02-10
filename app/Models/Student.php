<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    use SoftDeletes;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded =[];
    ///العلاقة مع جدول gender
    public function gender(){
        return $this->belongsTo('App\Models\Gender','gender_id');
    }
    
    
    
     public function grade(){
        return $this->belongsTo('App\Models\Grade','Grade_id');
    }
   
    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','Classroom_id');
    }
    
    public function section(){
        return $this->belongsTo('App\Models\Sections','section_id');
    }
    //علاقة لجلب الصور
    public function images(){
          return $this->morphMany('App\Models\Image','imageable');

    }
    //علاقة مع الجنسيات
    
     public function Nationality()
    {
        return $this->belongsTo('App\Models\Nationality', 'nationalitie_id');
    }
    // علاقة مع الاباء
   
    public function myparent(){
         return $this->belongsTo('App\Models\My_Parent12', 'parent_id');
 
    }
    public function student_account(){
         return $this->hasMany('App\Models\StudentAccount', 'student_id');
 
    }
    public function attendance(){
        return $this->hasMany('App\Models\Attends', 'student_id');
 
    }
       
}
