<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable=['question_id','question','options','course_id','class_id','isCompleted'];
    protected $casts =[
        'options'=>'array',
    ];
}
