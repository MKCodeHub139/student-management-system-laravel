@extends('index')
@section('title', 'Attendance')
@section('styles')
    <style>
        td {
            border-bottom: 1px solid rgb(202, 200, 200);
            padding: 1rem 0;
        }
    </style>
@endsection
@section('main')
    <div class="title-head flex justify-between my-5">
        <div class="page-title">
            <h2 class="text-3xl font-[500]">Attendance</h2>
            <p class="text-gray-500 text-[15px] mt-1">Mark and track student attendance</p>
        </div>
        <div class=" flex gap-5 h-[2.5rem] items-center">
            <button
                class="attendance-history-modal px-5 py-2 rounded-xl cursor-pointer border-1 border-gray-400"onclick="my_modal_4.showModal()">
                History</button>
            <button
                class="add-course-modal px-5 py-2 rounded-xl cursor-pointer border-1 border-gray-400"onclick="my_modal_3.showModal()">
                Export</button>
        </div>
    </div>
    <div class="search-div w-full border-2 mx-auto py-3 rounded-xl border-gray-300  flex justify-start gap-6 px-5 bg-white">
        <input type="date" name="attendance_date" id="attendance_date"
            class="border-1 border-gray-300  py-2 px-5 rounded-xl ">
        <select name="select" id="selectClass" class="border-1 border-gray-300  py-2 px-5 rounded-xl ">
            <option value="">Select Class </option>
            @foreach ($students->pluck('classModel')->unique('id') as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
    </div>
    <div id="analyticsContainer">
        @include('components.attendance-analytics')
    </div>

    <form action="" method="POST" class="attendance-form">
        @csrf
        <table class="w-full text-center my-5 border-1 border-gray-300 rounded-xl min-h-[10rem] text-center" id="myTable">
            <thead class="border-b-1 border-gray-300 h-[3rem] bg-gray-100">
                <tr class=" my-5 rounded">
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="attendance_table">
            </tbody>
        </table>
        <div class="">
            <button class="bg-primary btn rounded-xl text-white float-end mb-5 save-attendance-btn" type="submit">Save
                Attendance</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let date = $('#attendance_date').val()
            $.ajax({
                url: "{{ route('attendance.index') }}",
                type: 'GET',
                data: date,
                success: function(res) {

                }
            })
        })

        function loadAttendance(date = '', class_id) {
            $.ajax({
                url: '{{ route('attendance.render') }}',
                type: 'GET',
                data: {
                    date: date,
                    _t: Date.now(),
                    class_id: class_id
                },
                success: function(res) {
                    // console.log('AJAX RESPONSE:', res);
                    $('.attendance_table').html(res)
                }
            })
        }

        function loadAnalytics(date = '') {
            $.ajax({
                url: "{{ route('attendance.index') }}",
                type: 'GET',
                data: {
                    date: date
                },
                success: function(res) {
                    $('#analyticsContainer').html(res);
                }
            });
        }
        $(document).ready(function() {
            let date = $('#attendance_date').val()
            let class_id = $('#selectClass').val();
            loadAttendance(date, class_id);
            loadAnalytics(date);
        });
        $('#attendance_date, #selectClass').on('change', function() {
            let date = $('#attendance_date').val();
            let class_id = $('#selectClass').val();
            console.log("DATE:", date, "CLASS_ID:", class_id);

            loadAttendance(date, class_id);
            loadAnalytics(date, class_id)
        });



        $(document).on('click', '.attendance-btn', function(e) {
            e.preventDefault()
            let status = $(this).val();
            let row = $(this).closest('tr');
            let buttons = row.find('.attendance-btn');
            let attendanceStatus = row.find('.attendance-status');

            // Remove previous colors (row only)
            buttons.removeClass(
                'bg-green-100 text-green-700 bg-red-100 text-red-700 bg-orange-100 text-orange-700');
            attendanceStatus.removeClass(
                'bg-green-100 text-green-700 bg-red-100 text-red-700 bg-orange-100 text-orange-700');

            // Set new value in hidden/text input
            attendanceStatus.val(status);
            console.log(attendanceStatus.val())

            // Update data-status attribute so redraw pe bhi same dikhe

            // Apply color based on clicked button
            if (status === 'present') {
                $(this).addClass('bg-green-100 text-green-700');
                attendanceStatus.addClass('bg-green-100 text-green-700');
            } else if (status === 'late') {
                $(this).addClass('bg-orange-100 text-orange-700');
                attendanceStatus.addClass('bg-orange-100 text-orange-700');
            } else if (status === 'absent') {
                $(this).addClass('bg-red-100 text-red-700');
                attendanceStatus.addClass('bg-red-100 text-red-700');
            }
        });
        $(document).on('submit', '.attendance-form', function(e) {
            e.preventDefault()
            let formData = $(this).serialize();
            let date = $('#attendance_date').val();
            $.ajax({
                url: "{{ route('attendance.store') }}",
                type: 'POST',
                data: formData + '&date=' + date,
                success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: res.message,
                            timer: 3000,
                            showConfirmButton: false
                        })
                    }
                }

            })
        })
        // open history modal
        $(document).on('click', '.attendance-history-modal', function() {
            $.ajax({
                url: "{{ route('attendance.history') }}",
                type: "GET",
                success: function(res) {
                    $('.myForm').html(res)
                }
            })
        })
        // view Attendance history
        $(document).on('click', '.view_attendance_history', function() {
            let id = $(this).data('id')
            let date = $(this).data('date')
            $.ajax({
                url: "{{ route('attendance.view-history') }}",
                type: "GET",
                data: {
                    id: id,
                    date: date
                },
                success: function(res) {
                    $('.courseForm').html(res)
                }
            })
        })
        // delete attenance history
        $(document).on('click', '.delete-attendance', function() {
            let id = $(this).data('id')
            if (!id) {
                Swal.fire('error', 'Id not found !', 'error')
                return;
            }
            document.getElementById('my_modal_4').close();
            Swal.fire({
                title: 'Are you sure?',
                text: "This record will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'Yes, delete it!',

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/attendance/delete/' + id,
                        type: 'DELETE',
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted',
                                    iconColor: '#dc2626',
                                    text: res.message,
                                    timer: 3000,
                                    showConfirmButton: false
                                })
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection
