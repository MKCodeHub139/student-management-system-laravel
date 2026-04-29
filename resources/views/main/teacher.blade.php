@extends('index')
@section('title', 'teachers')
@section('main')

    <div class="title-head flex justify-between">
        <div class="page-title">
            <h2 class="text-3xl font-[500]">Teachers</h2>
            <p class="text-gray-500 text-[15px] mt-1">Manage all Teachers</p>
        </div>
        <div class="add-teacher-btn">
            <button
                class="add-teacher-modal bg-blue-500 px-5 py-2 text-white rounded-xl hover:bg-blue-400 cursor-pointer"onclick="my_modal_4.showModal()">+
                Add Teacher</button>
        </div>
    </div>



    <div class="search-div w-full border-2 mx-auto py-3 rounded-xl border-gray-300  flex justify-between px-5 my-5 bg-white">
        <input type="text" name="search" id=""
            class="w-[83%] mx-auto border-1 border-gray-300 py-2 rounded-xl px-3 search-input"
            placeholder="search by name or Roll number">
        <select name="class_filter" id=""
            class="class_filter border-1 border-gray-300 px-6 py-2 rounded-xl cursor-pointer">
            <option value="">Select class</option>
            {{-- @foreach ($classes as $class)
            <option value="{{$class->id}}">{{$class->name}}</option>
            @endforeach --}}

        </select>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.add-teacher-modal', function() {
            $.ajax({
                url: 'teachers/create',
                type: 'GET',
                success: function(res) {
                    $('.myForm').html(res)

                }
            })
        })
        $(document).on('submit', '.teacherForm', function(e) {
            e.preventDefault()
            let formData = new FormData(this)
            $.ajax({
                url: 'teachers/store',
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(res) {

                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    };
                    window.my_modal_4.close();
                }

            })
        })
    </script>
@endsection
