<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    //
    public function index(){
        return view('main.teacher');
    }
    public function create(){
        return view('teacherForm');
    }
    public function store(Request $request){
        if($request->ajax()){
            $res =Teacher::create([
                'teacher_name'=>$request->name,
                'email'=>$request->email,
                'phone_number'=>$request->phone,
                'subject'=>$request->subject,
                'qualification'=>$request->qualification,
                'hire_date'=>$request->hire_date,
                'address'=>$request->address,
                'role'=>'teacher',
                'password'=>Hash::make($request->password)
            ]);
        }
        return view('teacherForm');
    }
}
