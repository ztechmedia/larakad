@php
    $hour = [
        '07:00', '07:15', '07:30', '07:45', '08:00', '08:15','08:30', '08:45',
        '09:00', '09:15', '09:30', '09:45', '10:00', '10:15','10:30', '10:45',
        '11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30', '12:45',
        '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30', '14:45',
        '15:00', '15:15', '15:30', '15:45', '16:00', '16:15', '16:30', '16:45',
        '17:00', '17:15', '17:30', '17:45',
    ];

    $hours = [];
    foreach ($hour as $key => $value) {
        $hours[$value] = $value;
    }

    $day = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $days = [];
    foreach ($day as $key => $value) {
        $days[$value] = $value;
    }
@endphp

<input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?>" />

<div class="form-group">
    <label for="subject_id">Mata Pelajaran</label>
    {{ Form::select('subject_id', ['' => '-Pilih Mata Pelajaran-']+App\Models\Subject::pluck('name', 'id')->all(), 
        null, ['id' => 'subject_id', 'class' => 'form-control']) }}
    <div class="name-errors form-errors"></div>
</div>

<div class="form-group">
    <label for="teacher_id">Guru</label>
    {{ Form::select('teacher_id', ['' => '-Pilih Guru-']+App\Models\Teacher::pluck('name', 'id')->all(), 
        null, ['id' => 'teacher_id', 'class' => 'form-control']) }}
    <div class="name-errors form-errors"></div>
</div>


<div class="form-group">
    <label for="day">Hari</label>
    {{ Form::select('day', ['' => '-Pilih Hari-']+$days, 
        null, ['id' => 'day', 'class' => 'form-control']) }}
    <div class="name-errors form-errors"></div>
</div>

<div class="form-group">
    <label for="start">Waktu Mulai</label>
    {{ Form::select('start', ['' => '-Pilih Jam-']+$hours, 
        null, ['id' => 'start', 'class' => 'form-control']) }}
    <div class="subclass-errors form-errors"></div>
</div>

<div class="form-group">
    <label for="end">Waktu Berakhir</label>
    {{ Form::select('end', ['' => '-Pilih Jam-']+$hours, 
        null, ['id' => 'end', 'class' => 'form-control']) }}
    <div class="subclass-errors form-errors"></div>
</div>