@extends('teacher.default')
@section('teacherMain')
    <div class="main">
        <div class="title-head flex justify-between">
            <div class="page-title">
                <h2 class="text-3xl font-[500]">Make Question Paper</h2>
                <p class="text-gray-500 text-[15px] mt-1">Create a new question paper for your course</p>
            </div>
        </div>
        <div class="qty my-5 flex items-center gap-5">
            <label for="">How Many Questions?</label> <input type="number" name="question_count" id="" class="border-1 rounded px-5 w-[100px]" value="{{ $questionCount > 0 ? $questionCount : ''}}">
            <button class="bg-blue-500 hover:bg-blue-400 px-5 py-1 rounded cursor-pointer text-white generate-questions">Generate Questions</button>
        </div>
        <div class=" border-1 bord-700 rounded-xl p-5 my-5 bg-white">
            <div class=" float-end">
                <button class="bg-blue-500 hover:bg-blue-400 text-white px-4 py-2 rounded-lg cursor-pointer submit-question-paper">Save Question Paper</button>
            </div>
            <h2 class="text-2xl ">Subject: <span class="font-[500] text-blue-700"> {{$teacher->courses->where('id', $id)->first()->course_name}}</span></h2>
            @if($questionCount >0)
            <div class="questions">
                {{-- questions will be generated here --}}
            </div>
            @else
            <div class="questions border-1 border-gray-300 shadow-xl rounded-xl p-5 my-5 bg-white">
                <h2 class="text-center text-gray-500">No Questions Generated</h2>
            </div>
            @endif

        </div>
    </div>
@endsection
@section('teacherScripts')
<script>
    $(document).ready(function() {
        let questionCount = $('input[name="question_count"]').val();
        if(questionCount >0){
            $.ajax({
                url:'/teacher/generate-questions/{{$id}}',
                method:'GET',
                data:{count:questionCount},
                success:function(res){
                    $('.questions').html(res);
                }
                })
            }
        })
    $(document).on('click','.generate-questions',function(e){
        e.preventDefault();
        let questionCount = $('input[name="question_count"]').val();
        if(questionCount >0){
            $.ajax({
                url:'/teacher/generate-questions/{{$id}}',
                method:'GET',
                data:{count:questionCount},
                success:function(res){
                    $('.questions').html(res);
                }
        })
        // window.location.reload();
    }
    })
    $(document).on('click','.submit-question-paper',function(e){
        e.preventDefault();
        let questions = [];
        $('.question').each(function(){
            let questionId = $(this).attr('data-id');
            let question = $(this).find('.question-text').val();
            let option_1 = $(this).find('.option-1').val();
            let option_2 = $(this).find('.option-2').val();
            let option_3 = $(this).find('.option-3').val();
            let option_4 = $(this).find('.option-4').val();
            questions.push({
                question_id:questionId,
                question:question,
                options:[option_1,option_2,option_3,option_4]
            })
        })
        $.ajax({
            url:'/teacher/save-question-paper/{{$id}}',
            method:'POST',
            data:{questions:questions},
            success:function(res){
                alert(res.message);
                window.location.href = '/teacher/all-courses';
            }
        })
    })

</script>
@endsection
