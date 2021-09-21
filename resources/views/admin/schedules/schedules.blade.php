@extends('layouts.admin.app')

@section('pageTitle', setTitle('Jadwal Mata Pelajaranphp '))

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
        const url = setUrl("{{ route('schedules.classlist', ['level' => ':id']) }}", level);
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
        
    }
</script>
@endsection