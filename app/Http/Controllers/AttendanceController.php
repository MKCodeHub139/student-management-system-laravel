<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
public function index(Request $request)
{
    // ✔ hamesha date string (NO time)
    $date = $request->filled('date') ? $request->date : today()->toDateString();
    
    $studentsQuery = Student::with([
        'attendance' => function ($q) use ($date) {
            $q->whereDate('attendance_date', $date);
        }
    ]);

    $students = $studentsQuery->get();

    // saari attendance ek jagah
    $allAttendance = $students->pluck('attendance')->flatten();

    // analytics counts
    $analytics = [
        'total_students' => $students->count(),
        'present' => $allAttendance->where('status', 'present')->count(),
        'absent'  => $allAttendance->where('status', 'absent')->count(),
        'late'    => $allAttendance->where('status', 'late')->count(),
    ];

    // AJAX → sirf analytics
    if ($request->ajax()) {
        return view('components.attendance-analytics', compact('analytics'))->render();
    }

    // Normal page load
    return view('main.attendance', compact(
        'students',
        'date',
        'analytics'
    ));
}


public function render(Request $request)
{
    $date =$request->date ?? today();
    $studentsQuery = Student::with(['attendance' => function ($q) use ($date) {
        if ($date) {
            $q->whereDate('attendance_date', $date);
        }
    }]);
    if($request->class_id){
        $studentsQuery->where('class',$request->class_id);
    }
    $students = $studentsQuery->get();
    return view('partials.attendance_table', compact('students'))->render();
}


   public function store(Request $request)
{
    $request->validate([
        'id' => 'required|array',
        'status' => 'required|array',
        'date' => 'nullable|date',
    ]);

    $date = $request->date ?? today();
    foreach ($request->id as $key => $student_id) {

        $status = strtolower($request->status[$key] ?? '');

        // only valid enum values allowed
        if (! in_array($status, ['present', 'absent', 'late'])) {
            continue;
        }

      Attendance::updateOrCreate(
            [
                'student_id' => $student_id,
                'attendance_date' => $date,
            ],
            [
                'status' => $status,
            ]
        );
    }

    return response()->json([
        'success' => true,
        'message' => 'Attendance saved successfully'
    ]);
}
// render history modal
    public function history(){
        $attendances = Attendance::with('student.classModel')->get();
        return view('components.attendance-history', compact('attendances'));
    }
    // view history
    public function viewHistory(Request $request ){
        $classId =$request->id;
        $date=$request->date;
        $attendances = Attendance::with('student.classModel')
        ->whereDate('attendance_date', $date)
        ->whereHas('student', function ($q) use ($classId) {
            $q->where('class', $classId);
        })
        ->get();
        return view('components.view-attendance-history', compact('attendances'));
    }
    // destroy
    public function destroy($id){
        $attendance =Attendance::find($id);
        if($attendance){
            $attendance->delete();
            return response()->json([
                'success'=>true,
                'message'=>"Attendance Deleted Successfully",
            ]);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Attendance Not Found !',
        ]);
    }
}