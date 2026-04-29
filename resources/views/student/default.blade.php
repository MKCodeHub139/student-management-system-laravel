<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student</title>
</head>

<body>
    <nav class="bg-blue-400 h-[4rem] flex justify-between px-5 items-center">
        <h2 class="text-white text-2xl font-[500]">Student Dashboard</h2>
        <div class="flex gap-[1rem]">
            <h4 class="text-white text-xl">{{ $data->first_name . ' ' . $data->last_name }}</h4>
            <a href="/logout" class="bg-white px-3 py-1 rounded-2xl">Logout</a>
        </div>
    </nav>
    <div class="grid grid-cols-4 min-h-[90vh]">
        {{-- student sidebar --}}
        <div class="col-span-1 sidebar shadow border-1 border-gray-300 ">
            <ul class="flex flex-col">
                <a href="/student/check-exam">
                    <li
                        class="py-5 cursor-pointer text-blue-700  {{ request()->routeIs('student.checkExam', 'student.startExam') ? 'bg-blue-100' : '' }} hover:bg-blue-100 px-5">
                        Exam</li>
                </a>
                <a href="/student/view-results">
                    <li
                        class="py-5 cursor-pointer text-blue-700 {{ request()->routeIs('student.viewResults') ? 'bg-blue-100' : '' }} hover:bg-blue-100 px-5">
                       View Results</li>
                </a>
              
            </ul>
        </div>
        {{-- student main --}}
        <div class="col-span-3 p-5">@yield('student-main')</div>
    </div>

    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('student-script')
</body>

</html>
