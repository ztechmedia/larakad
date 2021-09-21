<div class="form-group" {{ isset($user) && $level !== 'admin' ? "style=display:none" : null}}>
    <label for="name">Nama Lengkap</label>
    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nama Lengkap']) }}
    <div class="name-errors form-errors"></div>
</div>

<div class="form-group">
    <label for="email">Email</label>
    {{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) }}
    <div class="email-errors form-errors"></div>
</div>

@if (last(request()->segments()) != 'edit')
<div class="form-group">
    <label for="password">Password</label>
    {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) }}
    <div class="password-errors form-errors"></div>
</div>

<div class="form-group">
    <label for="password_confirmation">Konfirmasi Password</label>
    {{ Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => 'Konfirmasi Password']) }}
    <div class="password_confirmation-errors form-errors"></div>
</div>
@endif

<div class="form-group">
    <div>
        {!! Form::submit('Simpan', ['class' => 'btn-submit btn btn-primary']) !!}
    </div>
</div>
