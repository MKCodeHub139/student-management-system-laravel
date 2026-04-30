<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\ExamResult;
use App\Models\Student;

class StudentDashboardController extends Controller
{
    //
    public function index()
    {
        $data = Student::with('classModel.courses')
            ->find(Auth::guard('student')->id());
        // $exam_results = ExamResult::all();
        // if ($exam_results->contains('student_id', $data->id)) {
        //     return redirect('/student/start-exam');
        // }

        return view('student.dashboard', compact('data'));
    }
    // view all courses for exam
    public function checkExam()
    {
        $data = Student::with('classModel.courses')
            ->find(Auth::guard('student')->id());
        $courses =[];
        $result = ExamResult::where('student_id', $data->id)->where('result', '!=', null)->get();
        $allQuestions = Question::where('class_id', $data->class)->get();
        $course_ids = $allQuestions->pluck('course_id')->unique();

            $courses = $data->courses->whereIn('id', $course_ids)->whereNotIn('id', $result->pluck('course_id'));

        return view('student.check_exam', compact('data', 'courses'));
    }
    public function examInstructions($id)
    {
        $data = Student::with('classModel.courses')
            ->find(Auth::guard('student')->id());
        $exam_results = ExamResult::where('student_id', $data->id)->exists();
        if ($exam_results) {
            return redirect('/student/start-exam/' . $id);
        }

        return view('student.exam_instructions', compact('data', 'id'));
    }
    public function startExam($id)
    {
        $data = Auth::guard('student')->user();


        // $result = ExamResult::where('student_id', $data->id)->first();

        $totalQuestion = collect();
      // Pehle check karo record exist karta hai ya nahi
     // Check existing result
    $result = ExamResult::where('student_id', $data->id)
        ->where('course_id', $id)
        ->first();

    // Agar record nahi mila to first time create karo
    if (!$result) {
        $result = ExamResult::create([
            'student_id' => $data->id,
            'course_id' => $id,
            'completed_question' => 1
        ]);
    }
        $question = null;
        $remainingSeconds = 0;

        if ($result && $result->created_at) {

            // Total Questions
            $totalQuestion = Question::where('class_id', $data->class)->where('course_id', $id)->get();
            $result->marksOutOf = $totalQuestion->count() * 5;


            // Time check (150 minutes = 2h 30m)
            $endTime = $result->created_at->copy()->addMinutes(150);

            $remainingSeconds = now()->diffInSeconds($endTime, false);

            if ($result->created_at->diffInMinutes(now()) >= 150 && $result->completed_question <= $totalQuestion->count()) {
                $result->completed_question = $totalQuestion->count() + 1;
                $result->save();
                }
                $result->save();

            $question = Question::where('class_id', $data->class)
                ->where('question_id', $result->completed_question)
                ->first();
        }
        // dd($question);
        return view('student.exam', compact(
            'question',
            'data',
            'totalQuestion',
            'result',
            'remainingSeconds'
        ));
    }


    public function forward(Request $request, $id)
    {
        $data = Auth::guard('student')->user();
        $result = ExamResult::where('student_id', $data->id)->first();
        $question = Question::where('class_id', $data->class)
            ->where('question_id', $result->completed_question)
            ->first();
        $totalQuestion = Question::where('class_id', $data->class)->get();
        // Time check (150 minutes = 2h 30m)
        $endTime = $result->created_at->copy()->addMinutes(150);

        $remainingSeconds = now()->diffInSeconds($endTime, false);

        $nextQuestion = Question::where('id', $id + 1)->first();
        $questions = $result?->questions;
        $questions[$id] = $request->input('formData');
        $result->questions = $questions;

        $result->completed_question = $result->completed_question + 1;
        if ($result->save()) {
            return view('student.exam', compact('data', 'question', 'result', 'totalQuestion', 'remainingSeconds'))->render();
        };
        return response()->json([
            'message' => 'Question not found'
        ], 404);
    }
    public function backward(Request $request, $id)
    {
        $data = Auth::guard('student')->user();
        $result = ExamResult::where('student_id', $data->id)->first();
        $question = Question::where('class_id', $data->class)
            ->where(' is_completed', '')
            ->first();
        $totalQuestion = Question::where('class_id', $data->class)->get();
        // Time check (150 minutes = 2h 30m)
        $endTime = $result->created_at->copy()->addMinutes(150);

        $remainingSeconds = now()->diffInSeconds($endTime, false);

        if ($id > 1) {
            $prevQuestion = Question::where('id', $id - 1)->first();
            $questions = $result->questions;
            $questions[$id] = $request->input('formData');
            $result->questions = $questions;
            $result->completed_question = $result->completed_question - 1;
            if ($result->save()) {
                return view('student.exam', compact('data', 'question', 'result', 'totalQuestion', 'remainingSeconds'))->render();
            };
        }
        return response()->json([
            'message' => 'Question not found'
        ], 404);
    }


    // view Results
    public function viewResults()
    {
        $data = Auth::guard('student')->user();
        $result = ExamResult::where('student_id', $data->id)->get();
        return view('student.view_results', compact('data', 'result'));
    }
}
