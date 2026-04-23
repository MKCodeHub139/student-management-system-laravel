<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Attendance;
class Teacher extends Authenticatable
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
        'role',
    ];
    protected $hidden = ['password'];
    public function courses(){
        return $this->hasMany(Course::class, 'teacher_id');
    }
    public function Student(){
        return $this->belongsToMany(Course::class);
    }
    // public function attendance(){
    //     return $this->hasMany(Attendance::class, 'student_id');
    // }
}
