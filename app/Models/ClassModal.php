<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
class ClassModal extends Model
{
    //
    protected $table = 'classes';
    protected $fillable = [
        'name',
    ];
    public function students(){
        return $this->hasMany(Student::class,'class');
    }
    
    public function courses(){
        return $this->hasMany(Course::class,'class_id');
    }
    
    
}
