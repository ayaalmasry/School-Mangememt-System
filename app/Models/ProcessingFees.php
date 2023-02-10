<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingFees extends Model
{
    public function student(){
        return $this->belongsTo('App\Models\Student','student_id');
    }
}
