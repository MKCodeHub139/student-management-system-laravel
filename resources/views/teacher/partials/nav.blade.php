 <div class="nav">
            <nav class="bg-blue-400 h-[4rem] flex justify-between px-5 items-center">
                <h2 class="text-white text-2xl font-[500]"><em>Teacher Dashboard</em> </h2>
                <div class="flex gap-[1rem]">
                    {{-- <h4 class="text-white text-xl">{{ $teacher->teacher_name }}</h4> --}}
                    <h4 class="text-white text-xl">{{ $teacher }}</h4>
                    <a href="/logout" class="bg-white px-3 py-1 rounded-2xl">Logout</a>
                </div>
            </nav>
        </div>