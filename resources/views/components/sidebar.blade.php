<div class="sidebar border-r-1 border-gray-300 min-h-[100vh] ">
    <div class="h-[5rem] flex items-center justify-center border-b-2 border-gray-200 mb-5">
        <h2 class="text-blue-500 text-2xl ">Student Management</h2>
    </div>
    <div>
        <ul class="m-0 p-0 list-none">
            <li class="m-0 p-0">
                <a href="/" class="block w-full p-5 hover:bg-gray-200 cursor-pointer {{request()->routeIs('dashboard.*')?'bg-blue-100 text-blue-800':''}}">Dashboard</a>
            </li>
            <li class="m-0 p-0">
                <a href="/students" class="block w-full p-5 hover:bg-gray-200  cursor-pointer {{request()->routeIs('student.*')?'bg-blue-100 text-blue-800':''}}">Students</a>
                </li>
            <li class="m-0 p-0">
                <a href="/attendance" class="block w-full p-5 hover:bg-gray-200  cursor-pointer {{request()->routeIs('attendance.*')?'bg-blue-100 text-blue-800':''}}">Attendance</a>
                </li>
            <li class="m-0 p-0 ">
             <a href="/courses" class="block w-full p-5 hover:bg-gray-200 cursor-pointer {{request()->routeIs('courses.*')?'bg-blue-100 text-blue-800':''}}">Course</a>

            </li>
        </ul>
    </div>
</div>