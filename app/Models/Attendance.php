<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Attendance extends Model
{
    //
    protected $table = 'attendance';
    protected $fillable =['student_id','status','attendance_date'];
    
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
}
