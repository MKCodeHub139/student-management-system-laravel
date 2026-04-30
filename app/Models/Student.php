<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassModal;
use App\Models\Attendance;
use App\Models\Course;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Student extends Authenticatable
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'role',
        'password',
        'blood_group',
        'status',
        'role_no',
        'class',
        'section',
        'courses_id',
        'admission_date',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'address',
        'image',
    ];
    protected $casts =[
        'courses_id'=>'array',
    ];
    protected $hidden = ['password'];
    public function classModel(){
        return $this->belongsTo(ClassModal::class,'class');
    }
    public function attendance(){
        return $this->hasMany(Attendance::class,'student_id');
    }
    public function courses(){
        return $this->belongsToMany(Course::class);
    }
    
 
}
