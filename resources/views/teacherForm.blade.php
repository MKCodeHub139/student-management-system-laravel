<h2 class="text-3xl font-[500]">Add New Teacher</h2>
<form action="" class="p-5 grid grid-cols-2 gap-5 teacherForm" method="post">
    @csrf
    <div class="flex flex-col gap-3">
        <label for="">Name</label>
        <input type="text" name="name" id="" class="px-3 py-1 border-1 rounded-xl border-gray-500">
    </div>
    <div class="flex flex-col gap-3">
        <label for="">Email</label>
        <input type="text" name="email" id="" class="px-3 py-1 border-1 rounded-xl border-gray-500">
    </div>
    <div class="flex flex-col gap-3">
        <label for="">Phone Number</label>
        <input type="text" name="phone" id="" class="px-3 py-1 border-1 rounded-xl border-gray-500">
    </div>
    <div class="flex flex-col gap-3">
        <label for="">Password</label>
        <input type="password" name="password" id="" class="px-3 py-1 border-1 rounded-xl border-gray-500">
    </div>
    <div class="flex flex-col gap-3">
        <label for="">Subject</label>
        <input type="text" name="subject" id="" class="px-3 py-1 border-1 rounded-xl border-gray-500">
    </div>
    <div class="flex flex-col gap-3">
        <label for="">Qualification</label>
        <input type="text" name="qualification" id="" class="px-3 py-1 border-1 rounded-xl border-gray-500">
    </div>
    <div class="flex flex-col gap-3">
        <label for="">Hire Date</label>
        <input type="date" name="hire_date" id="" class="px-3 py-1 border-1 rounded-xl border-gray-500">
    </div>
    <div class="flex flex-col gap-3">
        <label for="">Address</label>
        <textarea name="address" id="" cols="30" rows="3" class="px-3 py-1 border-1 rounded-xl border-gray-500"></textarea>
    </div>
    <div class="col-span-2">
        <button type="submit" class="float-end bg-blue-500 text-white px-5 py-2 rounded-xl cursor-pointer hover:bg-blue-400">Add Teacher</button>
    </div>
</form>