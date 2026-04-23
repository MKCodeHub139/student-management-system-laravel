@extends('teacher.default')
@section('teacherMain')
    <div class="main">
        <div class="title-head flex justify-between">
            <div class="page-title">
                <h2 class="text-3xl font-[500]">All Courses</h2>
                <p class="text-gray-500 text-[15px] mt-1">Make Question Paper By Course</p>
            </div>
        </div>
        <div class="all-courses">
        @foreach ($courses as $course)
            <div class="course-card border-1 border-gray-300 rounded-xl p-5 my-5 bg-white">
                <h3 class="text-xl font-[500]">{{ $course->course_name }}</h3>
                <p class="text-gray-500">{{ $course->course_code }}</p>
                <a href="/teacher/make-question-paper/{{ $course->id }}" class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg">Make Question Paper</a>
            </div>
        @endforeach
        </div>
    </div>
    @endsection