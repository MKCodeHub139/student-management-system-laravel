<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ClassModal;
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
{
    //
    public function index(Request $request){
        $classes = ClassModal::all();
        if($request->ajax()){
            $students=Student::with('classModel')->select('id','first_name','last_name','email','phone','class','status','role_no','image');
             $search = $request->get('query');
        if ($search) {
                 $students->where(function ($q) use ($search) {
                     $q->where('first_name', 'like', '%'.$search.'%')
                     ->orWhere('last_name', 'like', '%'.$search.'%')
                     ->orWhere('role_no', 'like', '%'.$search.'%');
         });
        }
        $class_filter=$request->get('class_filter_id');
        if($class_filter){
           $students->where('class',$class_filter);
        }


            return DataTables::of($students)
            ->addColumn('name',function($row){

                return '
                    <div class="flex items-center gap-2">
                        <img 
                            src="'.asset('uploads/image/'.$row->image).'" 
                            class="w-8 h-8 rounded-full object-cover"
                            alt="student"
                        >
                        <span>'.$row->first_name.' '.$row->last_name.'</span>
                    </div>
';

            })
            ->addColumn('class', function ($row) {
             return $row->classModel?->name ?? '-';
            })
            ->addColumn('action', function($row){
                $btn='<a href="/admin/student/view/'.$row->id.'" class="edit-modal-btn btn bg-amber-500 btn-sm" data-id="'.$row->id.'">View</a>
                <button class="edit-modal-btn btn btn-primary btn-sm" data-id="'.$row->id.'" onclick="my_modal_4.showModal()">Edit</button>
                <button class="delete-modal-btn btn btn-danger btn-sm" data-id="'.$row->id.'" onclick="my_modal_1.showModal()" >Delete</button>';
                return $btn;
            })
            ->rawColumns(['action','name'])
            ->make(true);
        }
        return view('main.student',compact('classes'));
    }
    public function create(){
        $classes=ClassModal::all();
        $student = new Student;
        return view('form',compact('student','classes'));
    }
    public function store(Request $request){
        if(! $request->hasFile('image')) {
            $request->image = null;
        } else {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/image/'), $filename);
            $request->image = $filename;
        }
        $student = Student::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'date_of_birth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'blood_group' => $request->bloodGroup,
            'status' => $request->status,
            'role_no' => $request->roleNo,
            'role'=>'student',
            'class' => $request->class,
            'section' => $request->section,
            'admission_date' => $request->admissionDate,
            'guardian_name' => $request->guardianName,
            'guardian_phone' => $request->guardianPhone,
            'guardian_email' => $request->guardianEmail,
            'address' => $request->address,
            'image' => $request->image,
        ]);
          return response()->json([
    'success' => true,
    'message' => 'Student added successfully'
]);

    }
    public function destroy($id){
        $student =Student::find($id);
        if(!$student){
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }
        if($student->image){
            $oldImagePath = public_path('uploads/image/'.$student->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $student->delete();
            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully'
            ]);
        
    }
    public function edit(String $id){
        $classes=ClassModal::all();
        $student=Student::find($id);
        return view('form',compact('student','classes'));
    }
    public function update(Request $request,$id){
        $student=Student::find($id);
        if(!$student){
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ],404);
        }
        if(! $request->hasFile('image')) {
            $request->image = $student->image;
        } else {
            if($student->image){
                $oldImagePath = public_path('uploads/image/'.$student->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/image/'), $filename);
            $request->image = $filename;
        }
        $student->update([
             'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'blood_group' => $request->bloodGroup,
            'status' => $request->status,
            'role_no' => $request->roleNo,
            'class' => $request->class,
            'section' => $request->section,
            'admission_date' => $request->admissionDate,
            'guardian_name' => $request->guardianName,
            'guardian_phone' => $request->guardianPhone,
            'guardian_email' => $request->guardianEmail,
            'address' => $request->address,
            'image' => $request->image,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully'
        ]);
    }
    public function view($id){
        $student=Student::find($id);
        return view('main.view',compact('student'));
    }
}
