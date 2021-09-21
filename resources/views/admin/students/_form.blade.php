@section('css')
<link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@php
   $classes = classLevel();
@endphp

<div class="card-header">
    <h3 class="card-title">Tingkatan Sekolah</h3>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="level_id">Tingkatan</label>
                {{ Form::select('level_id', ['' => '- Pilih Tingkatan -']+App\Models\Level::pluck('name', 'id')->all(), null, ['id' => 'level_id', 'class' => 'form-control']) }}
                <div class="level_id-errors form-errors"></div>
            </div>
        </div>

        @if(!isset($student))
        <div class="col-6">
            <div class="form-group">
                <label for="email">Email</label>
                {{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) }}
                <div class="email-errors form-errors">Digunakan untuk login ke sistem</div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="card-header">
    <h3 class="card-title">Data Pribadi</h3>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="nis">NIS</label>
                {{ Form::text('nis', null, ['id' => 'nis', 'class' => 'form-control', 'placeholder' => 'Contoh: (202117001)']) }}
                <div class="nis-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="nisn">NISN</label>
                {{ Form::text('nisn', null, ['id' => 'nisn', 'class' => 'form-control', 'placeholder' => 'Contoh: (0078688264)']) }}
                <div class="nisn-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Contoh: (Alsista Oktria Mulya Utami)']) }}
                <div class="name-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                {{ Form::select('gender', ['L' => 'Laki - Laki', 'P' => 'Perempuan'], null, ['id' => 'gender', 'class' => 'form-control']) }}
                <div class="gender-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="birth_place">Tempat Lahir</label>
                {{ Form::text('birth_place', null, ['id' => 'birth_place', 'class' => 'form-control', 'placeholder' => 'Contoh: (Bekasi)']) }}
                <div class="birth_place-errors form-errors"></div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="birth_date">Tanggal Lahir</label>
                <div class="input-group date" id="birth_date_picker" data-target-input="nearest">
                    {{ Form::text('birth_date', null, [
                        'id' => 'birth_date', 
                        'class' => 'form-control datetimepicker-input', 
                        'data-inputmask-alias' => 'datetime',
                        'data-inputmask-inputformat' => 'dd-mm-yyyy',
                        'data-target' => '#birth_date_picker']) 
                    }}
                    <div class="input-group-append" data-target="#birth_date_picker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div class="birth_date-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                {{ Form::text('status', null, ['id' => 'status', 'class' => 'form-control', 'placeholder' => 'Contoh: (Anak Kandung)']) }}
                <div class="status-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="child_position">Anak Ke</label>
                {{ Form::number('child_position', null, ['id' => 'child_position', 'class' => 'form-control', 'placeholder' => 'Contoh: 1']) }}
                <div class="child_position-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                {{ Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Alamat']) }}
                <div class="address-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="mobile">Nomor Telpon</label>
                {{ Form::number('mobile', null, ['id' => 'mobile', 'class' => 'form-control', 'placeholder' => 'Contoh: (089517227009)']) }}
                <div class="mobile-errors form-errors"></div>
            </div>
        </div>
    </div>
</div>

<div class="card-header">
    <h3 class="card-title">Data Sekolah Asal</h3>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="school_origin">Sekolah Asal</label>
                {{ Form::text('school_origin', null, ['id' => 'school_origin', 'class' => 'form-control', 'placeholder' => 'Sekolah Asal']) }}
                <div class="school_origin-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="join_at_class">Diterima Dikelas</label>
                {{ Form::select('join_at_class', ['' => '-Pilih Kelas-']+$classes, null, ['id' => 'join_at_class', 'class' => 'form-control']) }}
                <div class="join_at_class-errors form-errors"></div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="join_date">Tanggal Masuk</label>
                <div class="input-group date" id="join_date_picker" data-target-input="nearest">
                    {{ Form::text('join_date', null, [
                        'id' => 'join_date', 
                        'class' => 'form-control datetimepicker-input', 
                        'data-inputmask-alias' => 'datetime',
                        'data-inputmask-inputformat' => 'dd-mm-yyyy',
                        'data-target' => '#join_date_picker']) 
                    }}
                    <div class="input-group-append" data-target="#join_date_picker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div class="join_date-errors form-errors"></div>
            </div>
        </div>
    </div>
</div>

<div class="card-header">
    <h3 class="card-title">Data Orang Tua</h3>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="father_name">Nama Ayah</label>
                {{ Form::text('father_name', null, ['id' => 'father_name', 'class' => 'form-control', 'placeholder' => 'Nama Ayah']) }}
                <div class="father_name-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="mother_name">Nama Ibu</label>
                {{ Form::text('mother_name', null, ['id' => 'mother_name', 'class' => 'form-control', 'placeholder' => 'Nama Ibu']) }}
                <div class="mother_name-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="parent_address">Alamat Orang Tua</label>
                {{ Form::text('parent_address', null, ['id' => 'parent_address', 'class' => 'form-control', 'placeholder' => 'Alamat Orang Tua']) }}
                <div class="parent_address-errors form-errors"></div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="parent_mobile">Nomor Telpon</label>
                {{ Form::number('parent_mobile', null, ['id' => 'parent_mobile', 'class' => 'form-control', 'placeholder' => 'Contoh: (089517227009)']) }}
                <div class="parent_mobile-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="father_job">Pekerjaan Ayah</label>
                {{ Form::text('father_job', null, ['id' => 'father_job', 'class' => 'form-control', 'placeholder' => 'Contoh: (Karyawan Swasta)']) }}
                <div class="father_job-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="mother_job">Pekerjaan Ibu</label>
                {{ Form::text('mother_job', null, ['id' => 'mother_job', 'class' => 'form-control', 'placeholder' => 'Contoh: (Ibu Rumah Tangga)']) }}
                <div class="mother_job-errors form-errors"></div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <div>
                    {!! Form::submit('Simpan', ['class' => 'btn-submit btn btn-primary']) !!}
                </div>
            </div> 
        </div>
    </div>
</div>

@section('scripts')
<script src="{{ asset('js/errorHandler.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

<script>
$('#birth_date_picker').datetimepicker({
    format: 'D-M-Y'
});

$('#join_date_picker').datetimepicker({
    format: 'D-M-Y'
});

$('#birth_date').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
$('#join_date').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
</script>
@endsection