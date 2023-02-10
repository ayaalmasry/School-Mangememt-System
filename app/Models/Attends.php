<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attends extends Model
{
    protected $guarded=[];
    
    
    
    
     public function students()
    {
        return $this->belongsTo('App\Models\Student','student_id');
    }
     public function grade()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }
    
    public function section()
    {
        return $this->belongsTo('App\Models\Sections','section_id');
    }



     
}
