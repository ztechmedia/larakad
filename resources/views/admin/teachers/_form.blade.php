<div class="card-header">
    <h3 class="card-title">Data Pribadi</h3>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="nip">NIP</label>
                {{ Form::text('nip', null, ['id' => 'nip', 'class' => 'form-control', 'placeholder' => 'Contoh: (9999-9999-9999-999)']) }}
                <div class="nip-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Contoh: (Andreas Simatubolong)']) }}
                <div class="name-errors form-errors"></div>
            </div>

            <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                {{ Form::select('gender', ['L' => 'Laki - Laki', 'P' => 'Perempuan'], null, ['id' => 'gender', 'class' => 'form-control']) }}
                <div class="gender-errors form-errors"></div>
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

            <div class="form-group">
                <label for="last_education">Pendidikan Terakhir</label>
                {{ Form::text('last_education', null, ['id' => 'last_education', 'class' => 'form-control', 'placeholder' => 'Contoh: (S1 - Teknik Informatika)']) }}
                <div class="last_education-errors form-errors"></div>
            </div>

            @if(!isset($teacher))
            <div class="form-group">
                <label for="email">Email</label>
                {{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) }}
                <div class="email-errors form-errors">Digunakan untuk login ke sistem</div>
            </div>
            @endif

            <div class="form-group">
                <div>
                    {!! Form::submit('Simpan', ['class' => 'btn-submit btn btn-primary']) !!}
                </div>
            </div> 
        </div>
    </div>
</div>