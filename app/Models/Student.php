<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassModal;
use App\Models\Attendance;
class Student extends Model
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'blood_group',
        'status',
        'role_no',
        'class',
        'section',
        'admission_date',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'address',
        'image',
    ];
    public function classModel(){
        return $this->belongsTo(ClassModal::class,'class');
    }
    public function attendance(){
        return $this->hasMany(Attendance::class,'student_id');
    }
    
 
}
