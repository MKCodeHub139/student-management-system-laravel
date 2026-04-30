<h3 class="font-bold text-lg text-xl">{{$student->id?'Edit Student':'Add New Student'}}</h3>
<p class="mt-1 text-[15px] text-gray-400">Enter Students details</p>

<form action="" class="mt-5 px-5 py-10 border-1 border-gray-300 rounded-xl  h-[100%] myForm" method="post" enctype="multipart/form-data">
    @csrf
    @if (isset($student->id))
        @method('PUT')
    @endif
    <input type="hidden" name="id" id=""value="{{ $student->id ? $student->id : '' }}">
    <h2 class="text-xl font-[400]">Personal Details</h2>
    <div class="form-card grid grid-cols-2 gap-4 mt-5">
        <div>
            <label for="firstNname">First Name</label>
            <input type="text" name="firstName" id="firstName" value="{{ $student->first_name }}"
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full">
        </div>
        <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName"
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->last_name }}">

        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->email }}">

        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="number" name="phone" id="phone"
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->phone }}">

        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->password }}">

        </div>
        <div>
            <label for="dateOfBirth">date Of Birth</label>
            <input type="date" name="dateOfBirth" id="dateOfBirth"
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->date_of_birth }}">

        </div>
        <div>
            <label for="gender">Gender</label><br>
            <select name="gender" id="" class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full">
                <option value="male" @if ($student->gender == 'male') selected @endif>Male</option>
                <option value="female"@if ($student->gender == 'female') selected @endif>Female</option>
                <option value="other"@if ($student->gender == 'other') selected @endif>Other</option>
            </select>
        </div>
        <div>
            <label for="bloodGroup">Blood Group</label><br>
            <select name="bloodGroup" id="" class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full">
                <option value="">Select Blood Group</option>
                <option value="A+" @if ($student->blood_group == 'A+') selected @endif>A+</option>
                <option value="A-"@if ($student->blood_group == 'A-') selected @endif>A-</option>
                <option value="B+"@if ($student->blood_group == 'B+') selected @endif>B+</option>
                <option value="B-" @if ($student->blood_group == 'B-') selected @endif>B-</option>
                <option value="O+"@if ($student->blood_group == 'O+') selected @endif>O+</option>
                <option value="O-"@if ($student->blood_group == 'O-') selected @endif>O-</option>
                <option value="AB+"@if ($student->blood_group == 'AB+') selected @endif>AB+</option>
                <option value="AB-"@if ($student->blood_group == 'AB-') selected @endif>AB-</option>
            </select>
        </div>
        <div>
            <label for="status">Status</label><br>
            <select name="status" id="" class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full">
                <option value="active"@if ($student->status == 'active') selected @endif>Active</option>
                <option value="inactive"@if ($student->status == 'inactive') selected @endif>Inactive</option>
            </select>
        </div>
    </div>

    <h2 class="text-xl font-[400] border-t-1 py-5 my-5 border-gray-300">Academic Information</h2>
    <div class="form-card grid grid-cols-2 gap-4">
        <div>
            <label for="">Role Number</label>
            <input type="text" name="roleNo" id=""
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->role_no }}">

        </div>
        <div>
            <label for="">Class</label><br>
            <select name="class" class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full">
                <option value="">Select Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" @if ($student->class == $class->id) selected @endif>
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>

        </div>
        <div>
            <label for="">Section</label><br>
            <select name="section" id="" class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full">
                <option value="">Select Section</option>
                <option value="a" @if ($student->section == 'a') selected @endif>A</option>
                <option value="b" @if ($student->section == 'b') selected @endif>B</option>
                <option value="c" @if ($student->section == 'c') selected @endif>C</option>
                <option value="d" @if ($student->section == 'd') selected @endif>D</option>
            </select>
        </div>
        <div>
            <label for="">Addmission Date</label>
            <input type="date" name="admissionDate" id=""
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->admission_date }}">

        </div>
    </div>
    <h2 class="text-xl font-[400] border-t-1 py-5 my-5 border-gray-300">Guardians Information</h2>
    <div class="form-card grid grid-cols-2 gap-4">
        <div>
            <label for="">Guardian Name</label>
            <input type="text" name="guardianName" id=""
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->guardian_name }}">

        </div>
        <div>
            <label for="">Guardian phone</label>
            <input type="text" name="guardianPhone" id=""
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->guardian_phone }}">

        </div>
        <div>
            <label for="">Guardian email</label>
            <input type="email" name="guardianEmail" id=""
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full" value="{{ $student->guardian_email }}">

        </div>
    </div>
    <h2 class="text-xl font-[400] border-t-1 py-5 my-5 border-gray-300">Guardians Information</h2>
    <div class="form-card ">
        <div>
            <label for="">Address</label><br>
            <textarea name="address" id="" cols="30" rows="3"
                class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full">{{ $student->address }}</textarea>
        </div>
        <div class="mt-5">
            <label for="">Image</label><br>
            @if($student->image)
            <img src="{{asset('uploads/image/'.$student->image)}}" alt=""  class="rounded-full my-5 w-[50px] h-[50px]">
            @endif
            <input type="file" name="image" id="" class="border-1 border-gray-300 rounded-xl px-3 py-2 w-full cursor-pointer">
        </div>
    </div>
    <div class="mb-10 mt-4">
        <button
            class="add-student bg-blue-500 px-5 py-2 text-white rounded-xl hover:bg-blue-400 cursor-pointer float-end "
            type="submit">
            {{ $student->id ? 'Update' : 'Add Student' }} </button>
    </div>
</form>
