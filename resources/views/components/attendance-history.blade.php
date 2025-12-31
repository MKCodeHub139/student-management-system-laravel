 <div class="">
     <div class="title-head flex justify-between my-5">
         <div class="page-title">
             <h2 class="text-2xl font-[500]">
                Attendance History</h2>
             <p class="text-gray-500 text-[15px] mt-1">View and manage past attendance records</p>
            </div>
            
        </div>
   <div class="attendance_history_cards flex flex-col gap-6">

@foreach ($attendances->groupBy('attendance_date') as $date => $dateAttendances)

    {{-- DATE LOOP --}}
    {{-- <h3 class="text-xl font-semibold">
        {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
    </h3> --}}

    {{-- CLASS LOOP --}}
    @foreach ($dateAttendances->groupBy(fn($a) => $a->student->classModel->id) as $classAttendances)

        @php
            $class = $classAttendances->first()->student->classModel;
        @endphp

        <div class="attendance_history_card border-1 border-gray-300 rounded-2xl h-[100px] grid grid-cols-3 p-5">

            <div class="history-content">
                <h4 class="text-[16px] font-[500]">
        {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
                </h4>

                <ul class="flex gap-5 text-[14px] mt-3">
                    <li class="text-green-700">
                        Present {{ $classAttendances->where('status','present')->count() }}
                    </li>
                    <li class="text-red-700">
                        Absent {{ $classAttendances->where('status','absent')->count() }}
                    </li>
                    <li class="text-orange-700">
                        Late {{ $classAttendances->where('status','late')->count() }}
                    </li>
                    <li>
                        Total {{ $classAttendances->count() }}
                    </li>
                </ul>
            </div>

            <div class="class">
                <span class="bg-blue-100 px-5 py-1 text-blue-700 rounded">
                    {{ $class->name }}
                </span>
            </div>

            <div class="history-actions flex justify-end items-center gap-3">
                <button class="btn view_attendance_history" data-id="{{$class->id}}" data-date="{{$date}}" onclick="my_modal_3.showModal()">view</button>
                <button class="btn bg-red-100 text-red-700 delete-attendance" data-id="{{$classAttendances->first()->id}}">delete</button>
            </div>

        </div>

    @endforeach

@endforeach

</div>

 </div>