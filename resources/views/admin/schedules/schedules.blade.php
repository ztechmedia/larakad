@extends('layouts.admin.app')

@section('pageTitle', setTitle('Jadwal Mata Pelajaran'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Jadwal Mata Pelajaran</h1>
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
                                    <label for="level_id">Kelas</label>
                                    {{ Form::select('class_id', 
                                        ['' => '- Pilih Kelas -'], 
                                        null, 
                                        ['id' => 'class_id', 'class' => 'form-control', 'onchange' => 'loadSchedule($(this).val())']) }}
                                </div>

                                <div class="form-group">
                                    <label for="level_id">Tahun Ajaran</label>
                                    <select class="form-control" id="year" name="year" onchange="loadSchedule($('#class_id').val())">
                                        @php
                                        for ($i=2018; $i <= date('Y'); $i++) { $y=$i.'-'.($i + 1);
                                            echo "<option value='$y'>$y</option>" ; } 
                                        @endphp 
                                    </select> 
                                </div> 

                                <div class="form-group">
                                    <label for="level_id">Semester</label>
                                    <select class="form-control" id="semester" name="semester" onchange="loadSchedule($('#class_id').val())">
                                       <option value="SM1">Semester 1</option>
                                       <option value="SM2">Semester 2</option>
                                    </select> 
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title">Daftar Mata Pelajaran</h3>
                    </div>

                    <div class="card-body">
                        <div class="class-list">
                            Silahkan pilih Kelas yang tersedia
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
<script type="text/javascript">
    let selectedLevel = null;
    let selectedClass = null;

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

    function loadSchedule(class_id) {
        selectedClass = class_id;
        let year = $("#year").val();
        let semester = $("#semester").val();
        const url = `{{ url('admin/schedules/list/${class_id}/${year}/${semester}') }}`;
        loadView(url, '.class-list');
    }

    function newSchedule() {
        let year = $("#year").val();
        let semester = $("#semester").val();
        const url = `{{ url('admin/schedules/create/${selectedClass}/${year}/${semester}') }}`;
        customModal('modal-default', 'Tambah Jadwal', url);
    }

    function edit(id) {
        const url = setUrl("{{ route('schedules.edit', ['schedule' => ':id']) }}", id);
        customModal('modal-default', 'Edit Jadwal', url);
    }

    function destroy(id) {
        const url = setUrl("{{ route('schedules.destroy', ['schedule' => ':id']) }}", id);
        swal({
                title: "Hapus",
                text: "Yakin ingin menghapus jadwal tersebut ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            },
            function () {
                reqDelete(url, (err, res) => {
                    if (res.status == 'success') {
                        swal("Sukses", res.message, "success");
                        loadSchedule(selectedClass);
                    } else {
                        console.log('Err:', err);
                    }
                });
            }
        );
    }

    function ajaxResponse(context, res) {
        if(res.status == 'failed') {
            swal('Ops', res.message, 'error');
        } else {
            swal("Sukses", res.message, "success");
            loadSchedule(selectedClass);
            context.reset();
            if(res.update) $("#modal-default").modal('hide');
        }
    }
</script>
@endsection

@section('css')
    <style>
        .sch-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    </style>
@endsection