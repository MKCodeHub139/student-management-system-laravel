<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Attendance;
class Teacher extends Model
{
    //
    protected $fillable = [
        'teacher_name',
        'email',
        'phone_number',
        'subject',
        'qualification',
        'hire_date',
        'address',
    ];
    public function courses(){
        return $this->hasMany(Course::class, 'teacher_id');
    }
    // public function attendance(){
    //     return $this->hasMany(Attendance::class, 'student_id');
    // }
}
