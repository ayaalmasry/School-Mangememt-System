<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fees_invoices extends Model
{
    public function grade(){
        return $this->belongsTo('App\Models\Grade','Grade_id');
    }
     public function Classroom(){
        return $this->belongsTo('App\Models\Classroom','Classroom_id');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Sections', 'section_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Models\Fee', 'fee_id');
    }
}
