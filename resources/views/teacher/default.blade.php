<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div class="main">
       {{-- navbar --}}
       @include('teacher.partials.nav',['teacher'=>$teacher->teacher_name])
        <div class="grid grid-cols-4 min-h-[90vh]">
          {{-- sidebar --}}
          @include('teacher.partials.sidebar')
            <div class=" col-span-3 p-5">
                @yield('teacherMain')
            </div>
        </div>
    </div>
    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
    {{-- SweerAlert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    </script>
    @yield('teacherScripts')
</body>

</html>
