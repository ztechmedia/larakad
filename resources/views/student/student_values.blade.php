@extends('layouts.admin.app')

@section('pageTitle', setTitle('Daftar Kelas'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Nilai Saya</h1>
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
                        <h3 class="card-title">Daftar Tingkatan</h3>
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
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title">Daftar Kelas</h3>
                    </div>

                    <div class="card-body">
                        <div class="class-list">
                            Silahkan pilih Tingkatan Sekolah yang tersedia
                        </div>

                        <div class="detail-values"></div>
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

    function loadClass(level) {
        selectedLevel = level;
        if (level) {
            loading(".class-list");
            const url = setUrl("{{ route('s_values.class_list', ['level' => ':id']) }}", level);
            loadView(url, '.class-list');
        } else {
            $('.class-list').html('Silahkan pilih Tingkatan Sekolah yang tersedia');
        }
    }

    function detailValue(student_id, class_id, semester, year) {
        const url = `{{ url('s_values/detail_values/${student_id}/${class_id}/${semester}/${year}') }}`;
        loadView(url, '.detail-values');
    }
</script>

@endsection