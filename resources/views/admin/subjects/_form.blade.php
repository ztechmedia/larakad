<div class="card-header">
    <h3 class="card-title">Data Mata Pelajaran</h3>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-6">

            <div class="form-group">
                <label for="name">Nama Mata Pelajaran</label>
                {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Contoh: (Bahasa Indonesia)']) }}
                <div class="name-errors form-errors"></div>
            </div>

            <div class="form-group">
                <div>
                    {!! Form::submit('Simpan', ['class' => 'btn-submit btn btn-primary']) !!}
                </div>
            </div> 
        </div>
    </div>
</div>