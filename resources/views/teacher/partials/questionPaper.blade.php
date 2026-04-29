      @for ($i = 1; $i <= $questionCount; $i++)
          <div class="question  rounded-xl p-5 my-5 bg-white " data-id="{{$i}}">
              <p for="">Q{{ $i }}. </p>
              <textarea name="{{$i}}" id="" cols="100" rows="2" class="border-1 border--300 rounded-xl px-2 question-text"
                  placeholder="Enter Your Question">{{$questionPaper[$i]->question?? ''}}</textarea>
              <div class="options flex gap-5 mt-3">
                  <div class="option">
                      <input type="text" name="option_{{ $i }}_1" id="" class="border-1  rounded-xl px-2 option-1"
                          placeholder="Option 1" value="{{$questionPaper[$i]->options[0] ?? ''}}">
                  </div>
                  <div class="option">
                      <input type="text" name="option_{{ $i }}_2" id="" class="border-1  rounded-xl px-2 option-2"
                          placeholder="Option 2" value="{{$questionPaper[$i]->options[1] ?? ''}}">
                  </div>
                  <div class="option">
                      <input type="text" name="option_{{ $i }}_3" id="" class="border-1  rounded-xl px-2 option-3"
                          placeholder="Option 3" value="{{$questionPaper[$i]->options[2] ?? ''}}">
                  </div>
                  <div class="option">
                      <input type="text" name="option_{{$i}}_4" id="" class="border-1  rounded-xl px-2 option-4"
                          placeholder="Option 4" value="{{$questionPaper[$i]->options[3] ?? ''}}">
                  </div>
              </div>
          </div>
      @endfor
