@extends('student.default')
@section('student-main')

<div class="main">
    <div class="title-head flex justify-between">
        <div class="page-title">
            <h2 class="text-3xl font-[500]">All Courses</h2>
            <p class="text-gray-500 text-[15px] mt-1">Check your exams and start test</p>
        </div>
    </div>
    <div class="courses">
        @if($courses->count() == 0)
        <p class="text-center text-gray-500 my-5">No courses available for exam.</p>
        @else
        @foreach ($courses as $course)
        <div class="course-card p-5 border-1 border-gray-300 rounded-xl shadow-md my-5">
            <h2 class="text-xl font-[500]">{{$course->course_name}}</h2>
            <p class="text-gray-500 text-[15px] mt-1">Course Code: {{$course->course_code}}</p>
            <div class="my-5">
                <a href="/student/exam-instructions/{{$course->id}}" class="bg-green-400 hover:bg-green-300 cursor-pointer px-5 py-1 rounded-2xl">Start Exam</a>
            </div>
            
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection