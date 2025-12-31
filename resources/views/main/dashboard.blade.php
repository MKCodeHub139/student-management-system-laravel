@extends('index')
@section('title', 'Dashboard')
@section('main')
    <div class="">
        <div class="title-head flex justify-between my-5">
            <div class="page-title">
                <h2 class="text-3xl font-[500]">
                    Dashboard</h2>
                <p class="text-gray-500 text-[15px] mt-1">Welcome back to Student Management System</p>
            </div>
        </div>
        <div class="attendance_analatics_card grid grid-cols-4 gap-5 my-5">
            <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-gray-500">
                <div class="total_students">
                    <p class="text-[15px] text-gray-700">Total Students</p>
                    <h2 class="text-[25px] font-[500] mt-2">{{ $students->count() }}</h2>
                </div>
                <div class="course_icon"></div>
            </div>
            <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-gray-500 ">
                <div class="total_courses">
                    <p class="text-[15px] ">present Today</p>
                    <h2 class="text-[25px] font-[500] mt-2">
                        {{ $students->filter(function ($student) {
                                return $student->attendance->filter(fn($a) => $a->attendance_date == today()->toDateString() && $a->status == 'present')->isNotEmpty();
                            })->count() }}
                    </h2>
                </div>
                <div class="course_icon"></div>
            </div>
            <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-gray-500 ">
                <div class="total_courses">
                    <p class="text-[15px]">Total Courses</p>
                    <h2 class="text-[25px] font-[500] mt-2">
                        {{ $students->pluck('classModel')->unique('id')->sum(fn($class) => $class->courses->count()) }}
                    </h2>
                </div>
                <div class="course_icon">

                </div>
            </div>
            <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-gray-500 ">
                <div class="total_courses">
                    <p class="text-[15px] ">Avg Performance</p>
                    <h2 class="text-[25px] font-[500] mt-2">
                        40%
                    </h2>
                </div>
                <div class="course_icon">

                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-5">
            <div class="recent_sudents border-1 border-gray-300 rounded-2xl">
                <div class="header flex justify-between p-5 border-b-1 border-gray-300">
                    <h2 class="text-[20px] font-[600]">Recent Student</h2>
                    <a href="" class="text-blue-700 text-[15px]">View All</a>
                </div>
                <div class="body bg-white flex flex-col gap-5 mt-5">
                    <div class="card grid grid-cols-2 w-full py-5 px-10">
                        <div class="flex gap-3">
                            <div class="img h-[50px] w-[50px] bg-blue-100 rounded-full"></div>
                            <div class="">
                                <h2 class="name text-[17px] font-[500]">Mohd Kaif</h2>
                                <p class="text-gray-600 text-[15px]">Class 10</p>
                            </div>
                        </div>
                        <div class="col-end-8">
                            <p class="text-gray-700 text-[14px]">ROLL: 001</p>
                            <p class="text-green-600 text-[14px] float-end">A+</p>
                        </div>
                    </div>
                    <div class="card grid grid-cols-2 w-full py-5 px-10">
                        <div class="flex gap-3">
                            <div class="img h-[50px] w-[50px] bg-blue-100 rounded-full"></div>
                            <div class="">
                                <h2 class="name text-[17px] font-[500]">Mohd Kaif</h2>
                                <p class="text-gray-600 text-[15px]">Class 10</p>
                            </div>
                        </div>
                        <div class="col-end-8">
                            <p class="text-gray-700 text-[14px]">ROLL: 001</p>
                            <p class="text-green-600 text-[14px] float-end">A+</p>
                        </div>
                    </div>
                    <div class="card grid grid-cols-2 w-full py-5 px-10">
                        <div class="flex gap-3">
                            <div class="img h-[50px] w-[50px] bg-blue-100 rounded-full"></div>
                            <div class="">
                                <h2 class="name text-[17px] font-[500]">Mohd Kaif</h2>
                                <p class="text-gray-600 text-[15px]">Class 10</p>
                            </div>
                        </div>
                        <div class="col-end-8">
                            <p class="text-gray-700 text-[14px]">ROLL: 001</p>
                            <p class="text-green-600 text-[14px] float-end">A+</p>
                        </div>
                    </div>
                    <div class="card grid grid-cols-2 w-full py-5 px-10">
                        <div class="flex gap-3">
                            <div class="img h-[50px] w-[50px] bg-blue-100 rounded-full"></div>
                            <div class="">
                                <h2 class="name text-[17px] font-[500]">Mohd Kaif</h2>
                                <p class="text-gray-600 text-[15px]">Class 10</p>
                            </div>
                        </div>
                        <div class="col-end-8">
                            <p class="text-gray-700 text-[14px]">ROLL: 001</p>
                            <p class="text-green-600 text-[14px] float-end">A+</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="upcoming_events border-1 border-gray-300 rounded-2xl ">
                <div class="header flex justify-between p-5 border-b-1 border-gray-300">
                    <h2 class="text-[20px] font-[600]">Upcoming Events</h2>

                </div>
                <div class="card grid grid-cols-2 w-full py-5 px-10">
                    <div class="">

                        <h2 class="name text-[17px] font-[500]">Mid-Term Exam</h2>
                        <p class="text-gray-600 text-[15px]">15 Jan 2026</p>

                    </div>
                    <div class="col-end-8 flex items-center">
                        <p class="text-red-700 bg-red-100 text-[14px] px-3 rounded-full">Exam</p>
                    </div>
                </div>
                <div class="card grid grid-cols-2 w-full py-5 px-10">
                    <div class="col-span-3">

                        <h2 class="name text-[17px] font-[500]">Parent-Teacher Meating</h2>
                        <p class="text-gray-600 text-[15px]">18 feb 2026</p>

                    </div>
                    <div class="col-end-5 flex items-center">
                        <p class="text-blue-700 bg-blue-100 text-[14px] px-3 rounded-full">Meeting</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
