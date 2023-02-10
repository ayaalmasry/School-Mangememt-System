<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quession extends Model
{
    public function quizze(){
        return $this->belongsTo('App\Models\Quizz','quizze_id');
    }
}
