  <div class="col-span-1 sidebar shadow border-1 border-gray-300 ">
                <ul class="flex flex-col">
                   <a href="/teacher/view-examsheet"> <li class="py-5 cursor-pointer text-blue-700 {{request()->routeIs('teacher.viewExamsheet','teacher.checkExamsheet')? 'bg-blue-100':''}} hover:bg-blue-100 px-5">View Answer Sheet</li></a>
                   <a href="/teacher/all-courses"> <li class="py-5  cursor-pointer text-blue-700  hover:bg-blue-100 px-5 {{request()->routeIs('teacher.allCourses','teacher.make-question-paper')? 'bg-blue-100':''}}">Make Question Paper</li></a>
                </ul>
    </div>  