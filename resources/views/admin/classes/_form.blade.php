<div class="form-group">
    <label for="name">Tingkatan Kelas</label>
    {{ Form::select('name', ['' => '-Pilih Tingkatan Kelas-']+$classes, null, ['id' => 'name', 'class' => 'form-control']) }}
    <div class="name-errors form-errors"></div>
</div>

<div class="form-group">
    <label for="subclass">Kelompok Kelas</label>
    {{ Form::text('subclass', null, ['id' => 'subclass', 'class' => 'form-control', 'placeholder' => 'Contoh: (A, B, C...)']) }}
    <div class="subclass-errors form-errors"></div>
</div>