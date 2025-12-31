<form action="" class="courseForm">
    @csrf
    @if (isset($course->id))
        @method('PUT')
    @endif
    <input type="hidden" name="id" id="" value="{{$course->id ? $course->id :''}}">
    <div class="course_form_head">
        <h4 class="font-[500] text-[19px]">Add New Course</h4>
        <p class="text-gray-600 text-[14px]">Fill in the course details below to add a new course to the system.</p>
    </div>
    <div class="grid course_form_fields grid-cols-2 gap-4 my-5">
        <div>
            <label for="" class="text-[15px] font-[500]">Course Name *</label>
            <input type="text" value="{{$course->course_name}}" name="course_name" id="" class="bg-gray-100 px-3 w-full rounded py-1 text-[14px] mt-1 focus:outline-gray-400" placeholder="e.g. Mathmatics">
        </div>
        <div>
            <label for="" class="text-[15px] font-[500]">Course Code *</label>
            <input type="text" value="{{$course->course_code}}" name="course_code" id="" class="bg-gray-100 px-3 w-full rounded py-1 text-[14px] mt-1 focus:outline-gray-400" placeholder="e.g. MATH-101">
        </div>
        <div>
            <label for="" class="text-[15px] font-[500]">Class </label>
            <select name="class" id="" class="bg-gray-100 px-3 w-full rounded py-1 text-[14px] mt-1 focus:outline-gray-400 text-gray-600">
                <option value="">e.g. Class 10</option>
                @foreach ($classes as $class)
                <option value="{{$class->id}}" @if ($class->id == $course->class_id) selected @endif>{{$class->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="" class="text-[15px] font-[500]">Teacher Name *</label>
              <select name="teacher_id" id="" class="bg-gray-100 px-3 w-full rounded py-1 text-[14px] mt-1 focus:outline-gray-400 text-gray-600">
                <option value="">e.g. Mr.Sharma</option>
                @foreach ($teachers as $teacher)
                <option value="{{$teacher->id}}" @if ($teacher->id == $course->teacher_id) selected @endif>{{$teacher->teacher_name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="" class="text-[15px] font-[500]">Schedule </label>
            <input type="text" value="{{ !empty($course->schedule) ? implode(',', $course->schedule) : '' }}" name="schedule" id="" class="bg-gray-100 px-3 w-full rounded py-1 text-[14px] mt-1 focus:outline-gray-400" placeholder="e.g. Mon, Wed, Fri ">
        </div>
        <div>
            <label for="" class="text-[15px] font-[500]">Time </label>
            <input type="text" value="{{$course->time}}" name="time" id="" class="bg-gray-100 px-3 w-full rounded py-1 text-[14px] mt-1 focus:outline-gray-400" placeholder="e.g. 09:00 AM - 10:00 AM">
        </div>
        <div class="col-span-2">
            <label for="" class="text-[15px] font-[500]">Number Of Students </label>
            <input type="number" value="{{$course->number_of_students}}" name="number_of_students" id="" class="bg-gray-100 px-3 w-full rounded py-1 text-[14px] mt-1 focus:outline-gray-400">
        </div>
        <div class="col-span-2">
            <label for="" class="text-[15px] font-[500]">Description </label>
            <textarea name="description" id="" cols="30" rows="3" class="bg-gray-100 px-3 w-full rounded py-1 text-[14px] mt-1 focus:outline-gray-400" placeholder="Enter Course Description...">{{$course->description}}</textarea>
        </div>
    </div>
    <div class="btns w-full flex justify-end gap-4">
      
        <button type="submit" class="px-5 py-2 bg-gray-900 rounded-xl text-white cursor-pointer hover:bg-gray-800">
        {{$course->id ?'Update':'Add Course'}}
            </button>
    </div>
</form>