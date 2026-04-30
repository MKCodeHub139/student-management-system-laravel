<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Question;
use App\Models\ExamResult;
use App\Models\Course;


use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    //
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();
        if($teacher){
            return view('teacher.default', compact('teacher'));
        }
        return redirect('/login');
    }
    public function viewExamsheet()
    {
        $teacher = Auth::guard('teacher')->user();
        $course = Course::where('teacher_id', $teacher->id)->get();
        $exam_results = ExamResult::whereIn('course_id', $course->pluck('id'));
        // dd($exam_results->get());
        if (request()->ajax()) {
            $search = request()->get('query');
            if($search){
                $exam_results->whereHas('student', function($q) use ($search){
                    $q->where('first_name','like','%'.$search.'%')
                    ->orWhere('last_name','like','%'.$search.'%');
                });
            }
            $exam_results = $exam_results->get();
            return datatables()->of($exam_results)
                ->addColumn('Student Name', function ($data) {
                    return '<div class="flex items-center gap-3">' .
                        $data->student->first_name . ' ' . $data->student->last_name . '
                    <img src="' . asset('uploads/image/' . $data->student->image) . '" alt="" class="w-8 h-8 rounded-full">
                    </div>';
                })
                ->addColumn('Course', function ($data) {
                    return $data->course->course_name;
                })
                ->addColumn('Class', function ($data) {
                    return $data->student->classModel->name;
                })
                ->addColumn('Marks', function ($data) {
                    return $data->totalMarks;
                })
                ->addColumn('Marks Out Of', function ($data) {
                    return $data->marksOutOf;
                })
                ->addColumn('Grade', function ($data) {
                    return $data->grade;
                })
                ->addColumn('Result', function ($data) {
                    return '<div class="bg-black ' . ($data->result == "pass" ? "text-green-400" : "text-red-400") . ' rounded-xl flex items-center justify-center">' . $data->result . '</div>';
                })
                ->addColumn('Action', function ($data) {
                    return '<a href="/teacher/check-examsheet/' . $data->id . '" class="bg-green-600 hover:bg-green-500 text-white px-3 py-1 rounded-xl">Check</a>';
                })
                ->rawColumns(['Action', 'Student Name', 'Result'])
                ->make(true);
        }
        return view('teacher.view_examsheet', compact('exam_results', 'teacher'));
    }
    public function checkExamsheet($id)
    {
        $teacher = Auth::guard('teacher')->user();
        $exam_results = ExamResult::find($id);
        if($exam_results->questions==null){
           $exam_results->totalMarks=0;
            $exam_results->marks=[];
            $exam_results->grade='F';
                $exam_results->result='Fail';
            $exam_results->save();
        }
        $allQuestions = Question::where('course_id', $exam_results->course_id)->get();
        return view('teacher.check_examSheet', compact('exam_results', 'allQuestions', 'teacher'));
    }
    public function submitMarks(Request $request, $id)
    {
        $id = request()->route('id');
        $exam_results = ExamResult::find($id);
        $totalMarks = collect($request->marks)->sum('marks');
        $marksData = [];
        $marks = $request->input('marks');
        $marksOutOf = count($request->marks) * 5;
        // dd($marks);
        foreach ($marks as $mark) {
            if(!empty($mark['question_id']) && isset($mark['marks'])){
                $marksData[$mark['question_id']] = $mark['marks'];
            }
        }
        $exam_results->marks = $marksData;
        $exam_results->totalMarks = $totalMarks;
        $exam_results->marksOutOf = $marksOutOf;
        
        $percentage = ($totalMarks / $marksOutOf) * 100;
        if ($percentage >= 90) {
            $exam_results->grade = 'A+';
            $exam_results->result = 'Pass';
        } elseif ($percentage >= 80) {
            $exam_results->grade = 'A';
            $exam_results->result = 'Pass';
        } elseif ($percentage >= 70) {
            $exam_results->grade = 'B+';
            $exam_results->result = 'Pass';
        } elseif ($percentage >= 60) {
            $exam_results->grade = 'B';
            $exam_results->result = 'Pass';
        } elseif ($percentage >= 50) {
            $exam_results->grade = 'C';
            $exam_results->result = 'Pass';
        } else {
            $exam_results->grade = 'F';
            $exam_results->result = 'Fail';
        }
        $exam_results->save();
        return response()->json(['totalMarks' => $totalMarks, 'message' => 'Marks submitted successfully']);
        // $exam_results->marks=$totalMarks;
    }
    // make question paper
    public function allCourses()
    {
        $teacher = Auth::guard('teacher')->user();
        $courses =Course::where('teacher_id', $teacher->id)->get();
        return view('teacher.allCourses', compact('teacher', 'courses'));
    }
    public function makeQuestionPaper(Request $request,$id){
        $teacher = Auth::guard('teacher')->user();
        $questionCount=0;
        $classId=$teacher->courses->where('id',$id)->value('class_id');
        $questionPaper=Question::where('course_id',$id)->where('class_id',$classId)->get()->keyBy('question_id');
        if($questionPaper->count()>0){
            $questionCount=$questionPaper->count();
        }

        // if($request->ajax()){
        //     if($request->count){
        //         $questionCount=$request->count;
        //     }
        //    return view('teacher.partials.questionPaper', compact('teacher','id','questionCount'))->render();
        // }

        return view('teacher.make_questionPaper', compact('teacher','id','questionCount','questionPaper'));
    }
    public function generateQuestions($id){
        $teacher = Auth::guard('teacher')->user();
        $questionCount = request()->input('count');
        $classId=$teacher->courses->where('id',$id)->value('class_id');
        
        $questionPaper=Question::where('course_id',$id)->where('class_id',$classId)->get()->keyBy('question_id');

        return view('teacher.partials.questionPaper', compact('questionCount','questionPaper'))->render();

    }
    public function saveQuestionPaper(Request $request, $id){
        $teacher = Auth::guard('teacher')->user();
        $questions =$request->questions;
        foreach($questions as $value){
            Question::updateOrCreate([
                'course_id'=>$id,
                'class_id'=>$teacher->courses->where('id',$id)->first()->class_id,
                'question_id'=>$value['question_id']
                ],[
                'course_id'=>$id,
                'class_id'=>$teacher->courses->where('id',$id)->first()->class_id,
                'question_id'=>$value['question_id'],
                    'question'=>$value['question'],
                    'options'=>json_encode($value['options'], JSON_UNESCAPED_UNICODE),
                    'isCompleted' => false
                ]);
        }
        return response()->json(['message'=>'Question paper saved successfully']);
        
    }
}
