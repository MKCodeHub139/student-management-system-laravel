<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\ClassModal;
class Course extends Model
{
    //
    protected $fillable = [
        'course_name',
        'course_code',
        'class_id',
        'teacher_id',
        'schedule',
        'time',
        'number_of_students',
        'description',
    ];
    protected $casts = [
        'schedule' => 'array',
    ];
     public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
     public function classModel(){
        return $this->belongsTo(ClassModal::class, 'class_id');
    }
}
