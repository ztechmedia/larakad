{{ Form::open(['data-url' => route('student_values.store'), 'data-response' => 'custom', 'method' => 'post', 'class' => 'ajax-create']) }}
<div class="values-container" {{ $mode == 'detail' ? "style=padding:10px" : null }}>
    <input name="student_id" value="{{ $studentId }}" type="hidden" />
    <input name="class_id" value="{{ $classId }}" type="hidden" />
    <input name="year" value="{{ $year }}" type="hidden" />
    <input name="semester" value="{{ $semester }}" type="hidden" />
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($subjects as $subject)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $subject->subject->name }}</td>
                <td>
                    @php
                    $value = array_key_exists($subject->subject_id, $subvalues) ? $subvalues[$subject->subject_id] : null;
                    @endphp
                    @if(Auth::user()->hasRole('admin'))
                    <input {{ $mode == 'detail' ? 'readonly' : null }} type="number" class="form-control" value="{{ $value }}"
                        name="{{ "subject[$subject->subject_id]" }}" id="{{ "subject[$subject->subject_id]" }}" />
                    @else
                        @if($mode == 'detail')
                            <input readonly type="number" class="form-control" value="{{ $value }}"
                                name="{{ "subject[$subject->subject_id]" }}" id="{{ "subject[$subject->subject_id]" }}" />
                        @else
                            <input {{ $subject->teacher_id == $teacher_id ? null : 'readonly' }} type="number" class="form-control" value="{{ $value }}"
                                name="{{ "subject[$subject->subject_id]" }}" id="{{ "subject[$subject->subject_id]" }}" />
                        @endif
                    @endif
                </td>
            </tr>
            @php
            $no++;
            @endphp
            @endforeach
        </tbody>
    </table>

    @if($mode != 'detail')
    <div class="button-container">
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
    </div>
    @endif
</div>

{{ Form::close() }}