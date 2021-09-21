<div class="form-group">
    <label for="name">Nama Tingkatan</label>
    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nama Tingkatan']) }}
    <div class="name-errors form-errors"></div>
</div>

<div class="form-group">
    <label for="name">Singkatan</label>
    {{ Form::text('stand_for', null, ['id' => 'stand_for', 'class' => 'form-control', 'placeholder' => 'Singkatan']) }}
    <div class="stand_for-errors form-errors"></div>
</div>

<div class="form-group">
    <div>
        {!! Form::submit('Simpan', ['class' => 'btn-submit btn btn-primary']) !!}
    </div>
</div>