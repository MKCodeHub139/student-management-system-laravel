<div class="attendance_analatics_card grid grid-cols-4 gap-5 my-5">
        <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-blue-400">
            <div class="total_students">
                <p class="text-[15px] text-gray-700">Total Students</p>
                <h2 class="text-[25px] font-[500] mt-2">{{ $analytics['total_students']}}</h2>
            </div>
            <div class="course_icon"></div>
        </div>
        <div
            class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-green-400 text-green-700 bg-green-100">
            <div class="total_courses">
                <p class="text-[15px] ">present</p>
                <h2 class="text-[25px] font-[500] mt-2">
                    {{ $analytics['present'] }}
                </h2>
            </div>
            <div class="course_icon"></div>
        </div>
        <div
            class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-red-400 bg-red-100 text-red-700 ">
            <div class="total_courses">
                <p class="text-[15px]">Absent</p>
                <h2 class="text-[25px] font-[500] mt-2">
                    {{ $analytics['absent'] }}
                </h2>
            </div>
            <div class="course_icon">

            </div>
        </div>
        <div
            class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-orange-400 bg-orange-100 text-orange-700">
            <div class="total_courses">
                <p class="text-[15px] ">Late</p>
                <h2 class="text-[25px] font-[500] mt-2">
                    {{ $analytics['late'] }}
                </h2>
            </div>
            <div class="course_icon">

            </div>
        </div>
    </div>