<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\ClassModal;
use App\Models\Teacher;

class courseController extends Controller
{
    //
  
 public function index(Request $request)
{
    $courses = Course::with('teacher','classModel');
    
    $avgStudents = Course::avg('number_of_students');
    $search = $request->get('query');

    if ($search) {
        $courses->where(function($q) use ($search) {
            $q->where('course_name', 'like', '%'.$search.'%')
              ->orWhere('course_code', 'like', '%'.$search.'%')
              ->orWhere('teacher_id', 'like', '%'.$search.'%');
        });
    }

    $courses = $courses->get();

    // 🚀 if AJAX
    if($request->ajax()) {
        return view('components.courses_cards', [
            'courses' => $courses,
            'avgStudents' => $avgStudents
        ])->render();
    }

    // Normal page load
    return view('main.courses', compact('courses', 'avgStudents'));
}

    public function create(){
        $course =new Course;
        $classes=ClassModal::all();
        $teachers=Teacher::all();
        return view('courseForm',compact('classes','teachers','course'));
    }
    public function store(Request $request){
        if($request->ajax()){
            $scheduleArray = array_map(
                'trim',
                explode(',', $request->schedule)
            );
            $course=Course::create([
                'course_name'=>$request->course_name,
                'course_code'=>$request->course_code,
                'class_id'=>$request->class,
                'teacher_id'=>$request->teacher_id,
                'schedule'=>$scheduleArray,
                'time'=>$request->time,
                'number_of_students'=>$request->number_of_students,
                'description'=>$request->description,
            ]);
            return response()->json(['success'=>true,'message'=>'Course added successfully']);
        }
    }
    public function destroy($id){
        $course =Course::find($id);
        if(!$course){
            return response([
                'success'=>'false',
                'message'=>'Course Not Found !'
            ]);
        }
        $course->delete();
        return response([
                'success'=>'true',
                'message'=>'Course Deleted Successfully'
            ]);
    }
    public function update($id){
        $course = Course::find($id);
        $classes=ClassModal::all();
        $teachers=Teacher::all();
        return view('courseForm',compact('course','classes','teachers'));
    }
    public function edit(Request $request,$id){
        $course =Course::find($id);
        if(!$course){
            return response([
                'success'=>'false',
                'message'=>'User not found'
            ]);
        }
        $scheduleArray = array_map(
                'trim',
                explode(',', $request->schedule)
            );
        $course->update([
             'course_name'=>$request->course_name,
                'course_code'=>$request->course_code,
                'class_id'=>$request->class,
                'teacher_id'=>$request->teacher_id,
                'schedule'=>$scheduleArray,
                'time'=>$request->time,
                'number_of_students'=>$request->number_of_students,
                'description'=>$request->description,
        ]);
        return response([
            'success'=>'true',
            'message'=>'Course Updated Successfully',
        ]);
    }
}
