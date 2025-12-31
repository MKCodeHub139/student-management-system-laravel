@extends('index')
@section('title', 'students')
@section('main')
    <div class="title-head flex justify-between my-5">
        <div class="page-title">
            <h2 class="text-3xl font-[500]">Student Details</h2>
            <p class="text-gray-500 text-[15px] mt-1">Complete information about the student</p>
        </div>
        <div class="edit-btn">
            <button
                class="edit-student-modal bg-blue-500 px-5 py-2 text-white rounded-xl hover:bg-blue-400 cursor-pointer"onclick="my_modal_4.showModal()" data-id="{{ $student->id }}">
                Edit</button>

        </div>
    </div>
    <div class="grid grid-cols-3 gap-4 my-5">
        <div class="col-span-1 border-1 border-gray-300 rounded-2xl h-[100%] p-10">
            <div class="h-30 w-30 rounded-full mx-auto bg-blue-300 img overflow-hidden flex justify-center items-center">
                <img src="{{asset('uploads/image/'.$student->image)}}" alt="" class="object-cover rounded-full h-[100%] w-[100%]">
            </div>
            <h2 class="text-center text-2xl font-[500] mt-5">{{ $student->first_name }} {{ $student->last_name }}</h2>
            <p class="text-gray-600 text-[16px] my-1 text-center">Roll_No: {{$student->role_no}}</p>
            <div class="student_status flex justify-center w-full mt-5">
                <button class="{{($student->status=='active')?'bg-green-100 text-green-800':'bg-red-100 text-red-700' }} text-center px-4 py-1 rounded-2xl">{{$student->status}}</button>
            </div>
            <div class="student_contact_info my-10 flex flex-col gap-2">
                <p class="text-gray-700 text-[14px] tracking-wide">{{$student->email}}</p>
                <p class="text-gray-700 text-[14px] tracking-wide">{{$student->phone}}</p>
                <p class="text-gray-700 text-[14px] tracking-wide">{{$student->classModel->name}}</p>
                <p class="text-gray-700 text-[14px] tracking-wide">{{$student->date_of_birth}}</p>
            </div>
        </div>
        <div class="col-span-2  h-[100%]">
            <div class="personal_information border-1 border-gray-300 rounded-2xl p-10">
                <h5 class="text-xl font-[400]">Personal Information</h5>
                <div class="grid grid-cols-2 gap-7 mt-5 ">
                    <div class="gender">
                        <label for="" class="text-gray-700 text-[15px]">Gender</label>
                        <p class="text-[17px] mt-1 font-[400]">{{$student->gender}}</p>
                    </div>
                    <div class="blood_group">
                        <label for="" class="text-gray-700 text-[15px]">Blood Group</label>
                        <p class="text-[17px] mt-1 font-[400]">{{$student->blood_group}}</p>
                    </div>
                    <div class="date_of_birth">
                        <label for="" class="text-gray-700 text-[15px]">Date Of Birth</label>
                        <p class="text-[17px] mt-1 font-[400]">{{$student->date_of_birth}}</p>
                    </div>
                    <div class="addmission_date">
                        <label for="" class="text-gray-700 text-[15px]">Addmission Date</label>
                        <p class="text-[17px] mt-1 font-[400]">{{$student->admission_date}}</p>
                    </div>
                    <div class="address col-span-2">
                        <label for="" class="text-gray-700 text-[15px]">Address</label>
                        <p class="text-[17px] mt-1 font-[400]">{{$student->address}}</p>
                    </div>
    
    
                </div>
            </div>
            <div>
                <div class="guardians_information p-10 border-1 border-gray-300 rounded-2xl mt-5">
                    <h5 class="text-xl font-[400]">Guardians Information</h5>
                    <div class="grid grid-cols-2 gap-7 mt-5 ">
                    <div class="guardian_name">
                        <label for="" class="text-gray-700 text-[15px]">Guardians Name</label>
                        <p class="text-[17px] mt-1 font-[400]">{{$student->guardian_name}}</p>
                    </div>
                    <div class="guardian_phone">
                        <label for="" class="text-gray-700 text-[15px]">Guardians Phone</label>
                        <p class="text-[17px] mt-1 font-[400]">{{$student->guardian_phone}}</p>
                    </div>
                    <div class="guardian_email">
                        <label for="" class="text-gray-700 text-[15px]">Guardians Email</label>
                        <p class="text-[17px] mt-1 font-[400]">{{$student->guardian_email}}</p>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
    
@endsection

