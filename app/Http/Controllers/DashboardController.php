<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;

class DashboardController extends Controller
{
    //
    public function index(){
        // $attendances=Attendance::with('student')->get();
        $students=Student::with('attendance','classModel.courses')->get();
        // $attendance = Attendance::with('student')->get();
        return view('main.dashboard' ,compact('students'));
    }
}
