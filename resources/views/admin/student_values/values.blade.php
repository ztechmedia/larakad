@extends('layouts.admin.app')

@section('pageTitle', setTitle('Nilai Siswa'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Nilai Siswa</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Kelas</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="level_id">Tingkatan</label>
                                    {{ Form::select('level_id', 
                                        ['' => '- Pilih Tingkatan -']+App\Models\Level::pluck('name', 'id')->all(), 
                                        null, 
                                        ['id' => 'level_id', 'class' => 'form-control', 'onchange' => 'loadClass($(this).val())']) }}
                                </div>

                                <div class="form-group">
                                    <label for="class_id">Kelas</label>
                                    {{ Form::select('class_id', 
                                        ['' => '- Pilih Kelas -'], 
                                        null, 
                                        ['id' => 'class_id', 'class' => 'form-control', 'onchange' => 'loadStudent($(this).val())']) }}
                                </div>

                                <div class="form-group">
                                    <label for="year">Tahun Ajaran</label>
                                    <select class="form-control" id="year" name="year">
                                        @php
                                        for ($i=2018; $i <= date('Y'); $i++) { $y=$i.'-'.($i + 1);
                                            echo "<option value='$y'>$y</option>" ; } 
                                        @endphp 
                                    </select> 
                                </div> 

                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select class="form-control" id="semester" name="semester">
                                       <option value="SM1">Semester 1</option>
                                       <option value="SM2">Semester 2</option>
                                    </select> 
                                </div> 

                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title">Daftar Siswa</h3>
                    </div>

                    <div class="card-body">
                        <div class="student-list">
                            Silahkan pilih Kelas yang tersedia
                        </div>
                    </div>

                    <div id="input-values-form" style="display:none">
                        <div class="card-header">
                            <h3 class="card-title" id="card-title-input-values"></h3>
                        </div>
    
                        <div class="card-body">
                            <div class="input-values"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
@include('admin.modal.default')
@endsection

@section('scripts')
<script src="{{ asset('js/errorHandler.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>

<script>
    selectedLevel = null;
    selectedClass = null;
    selectedStudent = null;
    studentName = null;

    function loadClass(level) {
        selectedLevel = level;
        $('#class_id').empty();
        $('#class_id').append("<option value=''>- Pilih Kelas -</option>");
        const url = setUrl("{{ route('schedules.classes', ['level' => ':id']) }}", level);
        reqJson(url, 'GET', {}, (err, res) => {
            if(!err) {
                if(res.status === 'success') {
                    $('#class_id').append(res.classes);
                }
            }
        });
    }

    function loadStudent(classId) {
        let year = $("#year").val();
        const url = `{{ url('admin/student_values/student_list/${classId}/${year}') }}`;
        loadView(url, '.student-list');
    }

    function inputValues(studentId, classId, studentName) {
        selectedStudent = studentId;
        selectedClass = classId;
        studentName = studentName;
        let year = $("#year").val();
        let semester = $("#semester").val();
        const url = `{{ url('admin/student_values/input_values/${studentId}/${classId}/${year}/${semester}/input') }}`;
        $("#input-values-form").show();
        $("#card-title-input-values").html(`Input Nilai ${studentName}`);
        loadView(url, '.input-values');
    }

    function detailValues(studentId, classId, studentName) {
        let year = $("#year").val();
        let semester = $("#semester").val();
        const url = `{{ url('admin/student_values/input_values/${studentId}/${classId}/${year}/${semester}/detail') }}`;
        customModal('modal-default', `Detail Nilai ${studentName}`, url);
    }

    function ajaxResponse(context, res) {
        if(res.status == 'failed') {
            swal('Ops', res.message, 'error');
        } else {
            swal("Sukses", res.message, "success");
            inputValues(selectedStudent, selectedClass, studentName);
        }
    }
</script>
@endsection

@section('css')
<style>
    .custom-table tr td{
        padding: 5px;
    }

    .student-list {
        height: 300px;
        overflow: auto;
        overflow-y: scroll;
    }
</style>
@endsection