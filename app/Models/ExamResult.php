<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    //
    protected $fillable=['questions','totalMarks','marksOutOf','marks','grade','result','completed_question','student_id','course_id'];
    protected $casts = [
    'questions' => 'array', 
    'marks'=>'array',
];
public function student()
{
    return $this->belongsTo(Student::class);
}

public function course()
{
    return $this->belongsTo(Course::class);
}
}
