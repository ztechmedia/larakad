@extends('layouts.admin.app')

@section('pageTitle', setTitle('Pemetaan Kelas'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pemetaan Kelas</h1>
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
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="level_id">Tingkatan</label>
                                    {{ Form::select('level_id', 
                                        ['' => '- Pilih Tingkatan -']+App\Models\Level::pluck('name', 'id')->all(), 
                                        null, 
                                        ['id' => 'level_id', 'class' => 'form-control', 'onchange' => 'loadClass($(this).val())']) }}
                                </div>

                                <div class="form-group">
                                    <label for="level_id">Kelas</label>
                                    {{ Form::select('class_id', 
                                        ['' => '- Pilih Kelas -'], 
                                        null, 
                                        ['id' => 'class_id', 'class' => 'form-control', 'onchange' => 'loadStudent()']) }}
                                </div>

                                <div class="form-group">
                                    <label for="level_id">Tahun Ajaran</label>
                                    <select class="form-control" id="year" name="year" onchange="loadStudent()">
                                        @php
                                        for ($i=2018; $i <= date('Y'); $i++) { $y=$i.'-'.($i + 1);
                                            echo "<option value='$y'>$y</option>" ; } 
                                        @endphp 
                                    </select> 
                                </div> 
                            </div>

                            <div class="col-9 reg-containers">
                                <div class="student-registered">
                                    <div class="timeline">
                                        <div class="time-label">
                                            <span class="bg-red">Daftar Siswa Terdaftar</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-arrow bg-gray"></i>
                                            <div class="timeline-item">
                                                <span class="time"></span>
                                                <h3 class="timeline-header"><a>Silahkah pilih Tingkatan & Kelas</a></h3>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-arrow bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->hasRole('admin'))
                    <div class="card-header">
                        <h3 class="card-title">Daftar Siswa</h3>
                    </div>
                    
                    <div class="card-body">
                        <div class="student-list">
                            Silahkan pilih tingkatan sekolah & level
                        </div>
                    </div>
                    @endif
                    
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
    let selectedLevel = null;
    let selectedClass = null;

    function loadClass(level) {
        selectedLevel = level;
        $('#class_id').empty();
        $('#class_id').append("<option value=''>- Pilih Kelas -</option>");
        const url = setUrl("{{ route('schedules.classes', ['level' => ':id']) }}", level);
        reqJson(url, 'GET', {}, (err, res) => {
            if (!err) {
                if (res.status === 'success') {
                    $('#class_id').append(res.classes);
                }
            }
        });
    }

    $(".student-list").html();
    $(".student-registered").html();

    function loadStudent() {
        let level = $("#level_id").val();
        let classId = $("#class_id").val();
        let year = $("#year").val();
        loadRegisteredStudent();
        if (level && classId) {
            loadView(`{{ url('admin/classes/mapping_student/${classId}/${year}') }}`, '.student-list');
        } else {
            $(".student-list").html('Silahkan pilih Tingkatan Sekolah & Level');
        }
    }

    function loadRegisteredStudent() {
        let level = $("#level_id").val();
        let classId = $("#class_id").val();
        let year = $("#year").val();
        if (level && classId) {
            loadView(`{{ url('admin/classes/mapping_registered_student/${classId}/${year}') }}`, '.student-registered');
        } else {
            $(".student-registered").html('Silahkan pilih Tingkatan Sekolah & Level');
        }
    }

    function removeStudent(studentId) {
        let classId = $("#class_id").val();
        let year = $("#year").val();
        const url = `{{ url('admin/classes/mapping_remove_student/${studentId}/${classId}/${year}') }}`;

        swal({
                title: "Hapus",
                text: "Yakin ingin menghapus murid dari kelas tersebut ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            },
            function () {
                reqDelete(url, (err, res) => {
                    if (res) {
                        if(res.status == 'success') {
                            swal("Sukses", res.message, "success");
                            loadRegisteredStudent();
                        } else {
                            swal("Oops..", res.message, "error");
                        }
                    } else {
                        console.log('Err:', err);
                    }
                });
            }
        );
    }

    function selectStudent(studentId) {
        swal({
                title: "Tambahkan Siswa",
                text: "Yakin ingin menambahkan murid tersebut ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function () {
                const data = {
                    classId: $("#class_id").val(),
                    year: $("#year").val(),
                    studentId
                }
                reqJson("{{ route('classes.add_student') }}", 'POST', data, (err, res) => {
                    if (res) {
                        swal("Sukses", res.message, "success");
                        loadStudent();
                    } else {
                        console.log('Err:', err);
                    }
                });
            }
        );
    }
</script>
@endsection

@section('css')
<style>
    .custom-table tr td {
        padding: 5px;
    }

    .reg-containers {
        height: 300px;
        overflow-y: scroll;
        overflow: auto;
    }
</style>
@endsection