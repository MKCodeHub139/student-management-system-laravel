@extends('index')
@section('title', 'Courses')
@section('main')
    <div class="title-head flex justify-between my-5">
        <div class="page-title">
            <h2 class="text-3xl font-[500]">Courses</h2>
            <p class="text-gray-500 text-[15px] mt-1">Manage all courses and subjects</p>
        </div>
        <div class="add-course-btn">
            <button
                class="add-course-modal bg-blue-500 px-5 py-2 text-white rounded-xl hover:bg-blue-400 cursor-pointer"onclick="my_modal_3.showModal()">+
                Add Course</button>
        </div>
    </div>
    <div class="search-div w-full border-2 mx-auto py-3 rounded-xl border-gray-300  flex justify-between px-5 bg-white">
        <input type="text" name="search" id=""
            class="w-[100%] mx-auto border-1 border-gray-300 py-2 rounded-xl px-3 search-input"
            placeholder="Search courses by name , code or teacher ...">

    </div>
    <div class="course_analatics_card grid grid-cols-3 gap-5 my-5">
        <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-blue-400 bg-white">
            <div class="total_courses">
                <p class="text-[15px] text-gray-700">Total Courses</p>
                <h2 class="text-[25px] font-[500] mt-2">{{$courses->count()}}</h2>
            </div>
            <div class="course_icon"></div>
        </div>
        <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-blue-400 bg-white">
            <div class="total_courses">
                <p class="text-[15px] text-gray-700">Total Teachers</p>
                <h2 class="text-[25px] font-[500] mt-2">{{ $courses->pluck('teacher_id')->unique()->count() }}</h2>
            </div>
            <div class="course_icon"></div>
        </div>
        <div class="border-1 border-gray-300 rounded-xl p-5 flex justify-between items-center hover:border-blue-400 bg-white">
            <div class="total_courses">
                <p class="text-[15px] text-gray-700">Avg. Students/Course</p>
                <h2 class="text-[25px] font-[500] mt-2">{{$avgStudents}}</h2>
            </div>
            <div class="course_icon">
               
            </div>
        </div>

    </div>

<div class="courses_cards grid grid-cols-3 gap-5 my-5  ">
    @include('components.courses_cards', ['courses' => $courses,'avgStudents'=>$avgStudents])
</div>

<script>
$('.search-input').on('keyup', function () {
    let query = $(this).val();
    $.ajax({
        url: '{{ route("courses.index") }}',
        type: 'GET',
        data: { query },
        success: function (html) {
            $('.courses_cards').html(html);
        }
    });
});

</script>

@endsection
@section('scripts')
<script>
    // $(document).ready(function(){
    //      let query =$('.search-input').val();

    //     $.ajax({
    //         url:'{{route("courses.index")}}',
    //         type:'GET',
    //          data:{'query':query},

    //         success:function(res){
    //             //  $('.courses_cards').load(res)
    //             // console.log(res)
    //         }
    //     });
    // });
    $(document).on('click','.add-course-modal',function(){
        $.ajax({
            url:"courses/create",
            type:"GET",
            processData:false,
            contentType:false,
            success:function(res){
                $('.courseForm').html(res);
            }
        })
    })
    // store course
    $(document).on('submit','.courseForm',function(){
        let form =$(this);
        event.preventDefault();
        let id=form.find('input[name=id]').val();
        let url =id?"/courses/edit/"+id :'/courses/add';
        let formData=new FormData(this);
        $.ajax({
            url:url,
            type:"POST",
            data:formData,
            processData:false,
            contentType:false,
            success:function(res){
                if(res.success){
                Swal.fire({                    
                    icon: 'success',
                    title: 'Success',
                    text: res.message,
                    timer: 3000,
                    showConfirmButton: false
            });
            window.my_modal_3.close()
            setTimeout(() => location.reload(), 1000);
        }
            }
        })
    })
    // delete
    $(document).on('click','.course_delete_btn_modal',function(){
        let id =$(this).attr('data-id');
        if(!id){
            Swal.fire('error','Id not found !','error')
            return;
        }
        Swal.fire({
        title: 'Are you sure?',
        text: "This record will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'Yes, delete it!'
    }).then((result)=>{
        if(result.isConfirmed){
              $.ajax({
            url:'courses/delete/'+id,
            type:"DELETE",
            processData:false,
            contentType:false,
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
                setTimeout(() => location.reload(), 1000);
            }
        }
        })
        }

    })
        
    })
    // edit modal
    $(document).on('click','.course_edit_btn_modal',function(){
        let id=$(this).attr('data-id');
        $.ajax({
            url:'courses/update/'+id,
            type:'GET',
            processData:false,
            contentType:false,
            success:function(res){
                $('.courseForm').html(res);
            },
        });
    })
  
  

</script>
@endsection