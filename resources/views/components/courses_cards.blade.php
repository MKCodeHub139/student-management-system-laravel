<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @foreach ( $courses as $course)
            <div class="course_card border-1 border-gray-300 rounded-xl h-[100%] p-5 hover:shadow-2xl transition-all cursor-pointer bg-white">
            <div class="course_card_header flex justify-between">
                <div class="course_title flex justify-between w-full">
                    <div class="">
                        <h4 class="text-[19px] font-[400]">{{$course->course_name}}</h4>
                        <p class="text-[15px] text-gray-600">{{$course->course_code}}</p>
                    </div>
                    <div class="">
                         <button class="bg-blue-600 text-white cursor-pointer px-3 rounded-xl hover:bg-blue-500 course_edit_btn_modal" data-id="{{$course->id}}" onclick="my_modal_3.showModal()">edit</button>
                         <button class="bg-red-600 text-white cursor-pointer px-3 rounded-xl hover:bg-red-500 course_delete_btn_modal"  data-id="{{$course->id}}">delete</button>
                    </div>
                </div>
                <div class="course_actions"></div>
            </div>
            <div class="card_description my-6 text-gray-600 text-[14px]">
                <p>{{$course->description}}</p>
            </div>
            <div class="course_details flex flex-col gap-2 pb-5 border-b-1 border-gray-300 mb-5">
                <p class="text-[14px]"><span class="text-gray-600">Teacher:</span> {{$course->teacher?->teacher_name}}</p>
                <p class="text-[14px]"><span class="text-gray-600">Students:</span> {{$course->number_of_students}}</p>
                <p class="text-[14px]"><span class="text-gray-600">Schedule:</span> @foreach ($course->schedule as $day) {{$day}}, @endforeach</p>
                <p class="text-[14px]"><span class="text-gray-600">Time :</span> {{$course->time}}</p>
            </div>
            <button class="bg-blue-100 text-blue-700 text-[14px] px-3 py-1 rounded-2xl">{{$course->classModel?->name}}</button>
        </div> 
        @endforeach

