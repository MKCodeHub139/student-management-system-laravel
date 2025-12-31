  @foreach ($students as $student)
@php
    $attendance = $student->attendance->first()
@endphp


      <tr>
          <input type="hidden" name="id[]" value="{{ $student->id }}">
          <td>
              {{ $student->role_no }}
          </td>
          <td>
              <div class="flex items-center justify-center gap-2">
                  <img src="{{ asset('uploads/image/' . $student->image) }}" class="w-8 h-8 rounded-full object-cover"
                      alt="student">
                  <span>{{ $student->first_name . ' ' . $student->last_name }}</span>
              </div>
          </td>

          <td>
              <input type="text" name="status[]" readonly value="{{ $attendance->status ?? '' }}"
                  @class([
                      'attendance-status text-center w-[80px] rounded-2xl',
                      'bg-green-100 text-green-700' =>
                          $attendance && $attendance->status === 'present',
                      'bg-red-100 text-red-700' =>
                          $attendance && $attendance->status === 'absent',
                      'bg-orange-100 text-orange-700' =>
                          $attendance && $attendance->status === 'late',
                  ])>




          </td>
          <td>
              <div class="attendance-actions">
                  <button type="button" value="present" @class([
                      'attendance-btn btn',
                      'bg-green-100 text-green-700' => $attendance?->status === 'present',
                  ])>
                      P
                  </button>

                  <button type="button" value="absent" @class([
                      'attendance-btn btn',
                      'bg-red-100 text-red-700' => $attendance?->status === 'absent',
                  ])>
                      A
                  </button>

                  <button type="button" value="late" @class([
                      'attendance-btn btn',
                      'bg-orange-100 text-orange-700' => $attendance?->status === 'late',
                  ])>
                      L
                  </button>
              </div>

          </td>
      </tr>
  @endforeach
