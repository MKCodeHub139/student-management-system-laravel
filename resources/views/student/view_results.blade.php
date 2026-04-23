@extends('student.default')
@section('student-main')
<div class="main">
    <div class="title-head flex justify-between">
        <div class="page-title">
            <h2 class="text-3xl font-[500]">Exam Results</h2>
            <p class="text-gray-500 text-[15px] mt-1">Check your exam results</p>
        </div>
    </div>
    <table class="result-table table my-5 text-center">
        <thead class="bg-gray-100">
            <tr>
                <th>Course</th>
                <th>Marks</th>
                <th>Marks Out Of</th>
                <th>Grade</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $res)
            @if($res->result != null)
            <tr class="{{$res->result =='pass' ? 'bg-green-100':'bg-red-100'}}">
                <td>{{ $res->course->course_name }}</td>
                <td>{{ $res->totalMarks }}</td>
                <td>{{ $res->marksOutOf }}</td>
                <td>{{ $res->grade }}</td>
                <td> <span class="{{$res->result=='pass'?'bg-green-600':'bg-red-600'}} px-5 py-1 rounded-xl text-white">{{ $res->result }}</span></td>
            </tr>
            @else
            <tr class="bg-gray-100">
                <td>{{ $res->course->course_name }}</td>
                <td colspan="3">Result not available yet</td>
                </tr>
            @endif

            @endforeach
        </tbody>
    </table>
</div>
@endsection