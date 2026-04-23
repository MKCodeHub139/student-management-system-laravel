@extends('teacher.default')
@section('teacherMain')
<div class="main">
    <div class="title mb-10">
        <h2 class="text-3xl font-[500]">Check Exam Sheet</h2>
        <h3 class="text-[18px] font-[400]">Student Name: <span class="text-blue-700 font-[500]">{{$exam_results->student->first_name}} {{$exam_results->student->last_name}}</span></h3>
    </div>
    @if($exam_results->questions>0)
    @foreach ($exam_results->questions as $key => $question)
        <div class="my-4 p-4 border-1 border-gray-300 rounded-xl">
            <label for="" class="text-xl font-[400]">Q{{$key}}. {{ $allQuestions->where('question_id', $key)->first()->question }}</label><br>
            <label for="" class="text-[16px]"><span class="text-green-800 font-[500]">Answer:</span>  {{$question}}</label>
            <input type="number" name="question{{$key}}" value="{{$exam_results->marks[$key] ?? 0}}" id="" placeholder="Marks" class="border-1 border-blue-300 text-center rounded-2xl px-2 w-[100px]" min="0" max=5><br>
        </div>

    @endforeach
    <button class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2 rounded-xl float-end cursor-pointer submitMarks" >Submit Marks</button>
        @else
        <div class="text-center">
            <h2 class="text-2xl">No answer sheet found !</h2>
        </div>
    @endif
</div>
@endsection
@section('teacherScripts')
<script>
    $(document).on('click','.submitMarks',function(e){
        e.preventDefault();
        let marks = [];
        @foreach ($allQuestions as  $question)
            marks.push({
                question_id: {{$question->question_id}},
                marks: $(`input[name="question{{$question->question_id}}"]`).val()
            });
        @endforeach
        $.ajax({
            url:'/teacher/submit-marks/{{$exam_results->id}}',
            method:'POST',
            data:{
                marks:marks 
            },
            success:function(res){
                alert(res.message);
                window.location.href = '/teacher/view-examsheet';
            },
        })
    })
</script>
@endsection