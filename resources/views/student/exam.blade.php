@extends('student.default')
@section('student-main')

<h2 class="text-4xl absolute font-bold timer">00:00:00</h2>
<div class="question flex flex-col justify-center items-center min-h-[80vh]">
    {{-- @foreach ($questions as $question) --}}
    {{-- @if(now()->diffInMinutes($result?->created_at) >= 150)
    timeup
    @endif --}}
    
    @if($question?->id)
    <h2>{{$result->completed_question}}/{{$totalQuestion->count()}}</h2>
    <h2 class="text-xl font-[500]">Q{{$question?->question_id .'. '.$question?->question}}</h2>
 
    {{-- @endforeach --}}
    <div class="">
        <form action="" class="answer flex flex-col my-5 justify-center">
            <label for="">Answer :</label>
            @if(!empty(array_filter(json_decode($question->options, true) ?? [])))
            {{-- <h5>Choose 1 option</h5> --}}
            <div class="flex gap-10 justify-center">
                @foreach (json_decode($question->options, true) ?? [] as $option)
                {{-- {{$result->questions[$question->question_id]}} --}}
                <label>
        
        <input
            type="radio"
            name="option_{{ $question->id }}"
            class="answerInp"
            value="{{ $option }}"
            {{ (isset($result?->questions[$question->question_id]) && $result->questions[$question->question_id] == $option) ? 'checked' : '' }}
        >
        {{ $option }}
    </label>
@endforeach
            </div>
            @else
            <div class="">
                <textarea name="answer" id="" cols="100" rows="3" class="answerInp border-1 w-full rounded px-2" placeholder="Give Your Answer Here :">{{$result->questions[$result->completed_question] ?? ''}}</textarea>
            </div>
            @endif
        </form>
    </div>
    <div class="actions w-full flex justify-evenly my-5">
        <button class="bg-red-400 cursor-pointer hover:bg-red-300 px-5 py-1 rounded-2xl prev-question" data-id="{{$question->question_id}}">Prev</button>
        <button class="bg-green-400 cursor-pointer hover:bg-green-300 px-5 py-1 rounded-2xl next-question" data-id="{{$question->question_id}}">{{$totalQuestion->count() == $question->question_id ? 'Submit':'Next'}}</button>
    </div>
    
    @else
    <div>
        <h2 class="text-center text-2xl">{{$result?->questions ?count($result->questions):'0'}}/{{$totalQuestion ? $totalQuestion->count():'0'}}</h2>
        <h2>Exam Finish</h2>
    </div>
</div>
@endif
   
@endsection
@section('student-script')
<script>
  
    $(document).on('click','.next-question',function(){
        let formData;
        let id =$(this).attr('data-id')
        if($('.answerInp:checked').length > 0){
            formData =$('.answerInp:checked').val()
        }
        else{
            formData =$('.answerInp').val()
        }
        $.ajax({
            url:'/student/start-exam/forward/'+id,
            type:"POST",
            data:{formData},
            success:function(res){
                window.location.reload();
            }
            
        })
        
    })
    $(document).on('click','.prev-question',function(){
        let id =$(this).attr('data-id')
        let formData =$('.answerInp').val()
        // console.log(formData)
        $.ajax({
            url:'/student/start-exam/backward/'+id,
            type:"POST",
            data:{formData},
            success:function(res){
                window.location.reload();
            }
            
        })
        
    })

    // timer
         let time = {{ $remainingSeconds }};
    let timer = document.querySelector('.timer');

    let interval = setInterval(function() {

        let hours = Math.floor(time / 3600);
        let minutes = Math.floor((time % 3600) / 60);
        let seconds = Math.floor(time % 60);

        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        timer.innerHTML = `${hours}:${minutes}:${seconds}`;

        time--;

    }, 1000);
    if (time <= 0) {
    clearInterval(interval);
        alert('Time is up! The exam will be submitted automatically.');
}
</script>
@endsection