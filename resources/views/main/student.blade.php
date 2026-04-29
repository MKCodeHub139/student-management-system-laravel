@extends('index')
@section('title', 'students')
@section('styles')
<style>
    .dt-length{
        margin-top: 10px;
    }
    tr{
        height:60px !important;
    }
</style>
@endsection
@section('main')


    <div class="title-head flex justify-between">
        <div class="page-title">
            <h2 class="text-3xl font-[500]">Students</h2>
            <p class="text-gray-500 text-[15px] mt-1">Manage all stdents</p>
        </div>
        <div class="add-student-btn">
            <button
                class="add-student-modal bg-blue-500 px-5 py-2 text-white rounded-xl hover:bg-blue-400 cursor-pointer"onclick="my_modal_4.showModal()">+
                Add Student</button>
        </div>
    </div>



    <div class="search-div w-full border-2 mx-auto py-3 rounded-xl border-gray-300  flex justify-between px-5 my-5 bg-white">
        <input type="text" name="search" id=""
            class="w-[83%] mx-auto border-1 border-gray-300 py-2 rounded-xl px-3 search-input"
            placeholder="search by name or Roll number">
        <select name="class_filter" id="" class="class_filter border-1 border-gray-300 px-6 py-2 rounded-xl cursor-pointer">
            <option value="">Select class</option>
            @foreach ($classes as $class)
            <option value="{{$class->id}}">{{$class->name}}</option>
            @endforeach
            
        </select>
    </div>
    <table class="w-full my-5 border-1 border-gray-300 rounded-xl min-h-[10rem] text-center" id="myTable">
        <thead class="border-b-1 border-gray-300 h-[5rem] bg-gray-100">
            <tr class=" my-5 rounded">
                <th>Roll No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="bg-white">

        </tbody>
    </table>
@endsection
@section('scripts')
<script>
   $(document).on('click', '.add-student-modal',function(){
    $.ajax({
        url:"{{route('student.create')}}",
        method:"get",
        success:function(res){
            $('.myForm').html(res);
        }
    })
   })
   $('.class_filter').on('change', function(){
       $('#myTable').DataTable().ajax.reload();
   })
   $(document).ready(function () {
   $('#myTable').DataTable({
    processing:true,
    serverSide:true,
    searching:false,
    ajax:{
        url:"{{route('student.index')}}",
        data:function(d){
            d.query=$('.search-input').val();
            d.class_filter_id=$('.class_filter').val();
        }
    },
    columns:[
        {data:'role_no',name:'role_no'},
        {data:'name',name:'name'},
        {data:'email',name:'email'},
        {data:'class',name:'class'},
        {data:'phone',name:'phone'},
        {data:'status',name:'status'},
        {data:'action',name:'action',orderable:false,searchable:false},
    ]
   })
});
$(document).on('submit','.myForm',function(event){
    let form =$(this);
    let id =form.find('input[name="id"]').val();

    let url =id?"/admin/student/update/"+id :'/admin/student/add';
    let formData = new FormData(this);
    event.preventDefault();
    console.log(id);
    $.ajax({
        url:url,
        type:'POST',
         data: formData,
         contentType: false,
        processData: false, 
        success:function(res){
            if(res.success){
                Swal.fire({                    
                    icon: 'success',
                    title: 'Success',
                    text: res.message,
                    timer: 3000,
                    showConfirmButton: false
            });
            };
              $('.myForm').trigger('reset');
              window.my_modal_4.close();
            $('#myTable').DataTable().ajax.reload();
        }
    })
})

// delete student
let deleteId = null;

$(document).on('click', '.delete-modal-btn', function () {
     deleteId = $(this).attr('data-id'); 
});
$(document).on('click', '.delete-btn', function(){
     if (!deleteId) {
        Swal.fire('Error', 'ID not found', 'error');
        return;
    }
    $.ajax({
        url:"/admin/student/delete/"+deleteId,
        type:"DELETE",
        success:function(res){
            if(res.success){
                Swal.fire({
                    icon:'success',
                    title:'Deleted',
                    iconColor: '#dc2626',
                    text:res.message,
                    timer:3000,
                    showConfirmButton:false
                })
                $('#myTable').DataTable().ajax.reload();
                window.my_modal_1.close();
            }
        }
    })
})
// edit modal open
$(document).on('click','.edit-modal-btn',function(){
    let id=$(this).attr('data-id')
    $.ajax({
        url:'/admin/student/edit/'+id,
        type:'GET',
        success:function(res){
            $('.myForm').html(res);
        }
    })
})

// searchbar
$(document).on('keyup', '.search-input', function () {
    $('#myTable').DataTable().ajax.reload();
});

</script>
@endsection