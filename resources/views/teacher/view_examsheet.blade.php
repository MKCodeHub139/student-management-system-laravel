@extends('teacher.default')

@section('teacherMain')
    <div class="main">
        <div class="title-head flex justify-between">
            <div class="page-title">
                <h2 class="text-3xl font-[500]">Students</h2>
                <p class="text-gray-500 text-[15px] mt-1">Manage all stdents</p>
            </div>

        </div>



        <div
            class="search-div w-full border-2 mx-auto py-3 rounded-xl border-gray-300  flex justify-between px-5 my-5 bg-white">
            <input type="text" name="search" id=""
                class="w-[100%] mx-auto border-1 border-gray-300 py-2 rounded-xl px-3 search-input"
                placeholder="search by name or Roll number">
        </div>

        <table class="studentTable table text-center my-5">
            <thead class="bg-gray-100">
                <tr>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Class</th>
                    <th>Marks</th>
                    <th>Marks Out Of</th>
                    <th>Grade</th>
                    <th>Result</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($exam_results as $exam_result)
                    {{-- <tr>
                    <td class="flex gap-2.5 items-center">{{ $exam_result->student->first_name }} {{ $exam_result->student->last_name }} <img src="{{asset('uploads/image/'.$exam_result->student->image)}}" alt="" class="w-[50px] h-[50px] rounded-full"></td>
                    <td>{{ $exam_result->course->course_name }}</td>
                    <td>{{ $exam_result->student->classModel->name }}</td>
                    <td>{{ $exam_result->marks }}</td>
                    <td>{{ $exam_result->grade }}</td>
                    <td>{{ $exam_result->result }}</td>
                    <td><a href="">Check</a></td>
                </tr> --}}
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- @foreach ($exam_results as $exam_result)
    <div class="exam-result">
        <p>Student: {{ $exam_result->student->first_name }} {{ $exam_result->student->last_name }}</p>
        <p>Course: {{ $exam_result->course->course_name }}</p>
    </div>
@endforeach --}}
@endsection
@section('teacherScripts')
    <script>
        $(document).ready(function() {
            $('.studentTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('teacher.viewExamsheet') }}",
                    data: function(d) {
                        d.query = $('.search-input').val();
                        // d.class_filter_id=$('.class_filter').val();
                    }
                },
                columns: [{
                        data: 'Student Name',
                        name: 'Student Name'
                    },
                    {
                        data: 'Course',
                        name: 'Course'
                    },
                    {
                        data: 'Class',
                        name: 'Class'
                    },
                    {
                        data: 'Marks',
                        name: 'Marks'
                    },
                    {
                        data: 'Marks Out Of',
                        name: 'Marks Out Of'
                    },
                    {
                        data: 'Grade',
                        name: 'Grade'
                    },
                    {
                        data: 'Result',
                        name: 'Result'
                    },
                    {
                        data: 'Action',
                        name: 'Action',
                        orderable: false,
                        searchable: false
                    },
                ]
            })
        });
        // searchbar
        $(document).on('keyup', '.search-input', function() {
            $('.studentTable').DataTable().ajax.reload();
        });
    </script>
@endsection
