<div class="">
      <div class="title-head flex justify-between my-5">
         <div class="page-title">
             <h2 class="text-xl font-[500]">
                Attendance Details</h2>
             <p class="text-gray-500 text-[15px] mt-1"> {{ \Carbon\Carbon::parse($attendances->first()->attendance_date)->format('l, d F Y') }} - {{$attendances->first()->student->classModel->name}}</p>
            </div>
        </div>
        <div class="attendance_analatics_card grid grid-cols-4 gap-3 my-5">
        <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-blue-400 h-[80px]">
            <div class="total_students">
                <p class="text-[15px] text-gray-700">Total </p>
                <h2 class="text-[25px] font-[500] mt-1">
                    {{$attendances->count()}}
                </h2>
            </div>
            <div class="course_icon"></div>
        </div>
        <div
            class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-green-400 text-green-700 bg-green-100 h-[80px]">
            <div class="total_courses">
                <p class="text-[15px] ">present</p>
                <h2 class="text-[25px] font-[500] mt-1">
                    {{$attendances->where('status','present')->count()}}
                    {{-- {{ $analytics['present'] }} --}}
                </h2>
            </div>
            <div class="course_icon"></div>
        </div>
        <div
            class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-red-400 bg-red-100 text-red-700 h-[80px]">
            <div class="total_courses">
                <p class="text-[15px]">Absent</p>
                <h2 class="text-[25px] font-[500] mt-1">
                     {{$attendances->where('status','absent')->count()}}
                </h2>
            </div>
            <div class="course_icon">

            </div>
        </div>
        <div
            class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-orange-400 bg-orange-100 text-orange-700 h-[80px]">
            <div class="total_courses">
                <p class="text-[15px] ">Late</p>
                <h2 class="text-[25px] font-[500] mt-1">
                    {{$attendances->where('status','late')->count()}}
                </h2>
            </div>
            <div class="course_icon">

            </div>
        </div>
    </div>
     <table class="w-full text-center my-5 border-1 border-gray-300 rounded-xl min-h-[10rem] text-center" id="myTable">
            <thead class="border-b-1 border-gray-300 h-[3rem] bg-gray-100">
                <tr class=" my-5 rounded">
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="attendance_history_table">
                @foreach ($attendances as $attendance)
                <tr>
                    <td>
                        {{$attendance->student->role_no}}
                    </td>
                    <td>
                        {{$attendance->student->first_name . ' '. $attendance->student->last_name}}
                    </td>
                    <td>
                    <span  @class([
                        'px-3 py-1 rounded-2xl',
                        'bg-green-100 text-green-700'=>$attendance->status=='present',
                        'bg-red-100 text-red-700'=>$attendance->status=='absent',
                        'bg-orange-100 text-orange-700'=>$attendance->status=='late',

                    ])>
                        {{$attendance->status}}
                    </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>