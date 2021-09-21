@extends('layouts.auth.app')

@section('pageTitle', 'Arkan Islamic School | Lupa Password')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a><b>{{ __('Arkan') }}</b> {{ __('Islamic School') }}</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Reset Password') }}</p>

            {{ Form::open(['url' => route('password.update'), 'method' => 'post']) }}
            <input type="hidden" name="token" value="{{ $token }}">
            @if ($errors->has('email') || $errors->has('password') || $errors->has('password_confirmation'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Ops..!</h5>
                <p>{{ $errors->has('email') ? $errors->first('email', ':message') : null }}</p>
                <p>{{ $errors->has('password') ? $errors->first('password', ':message') : null }}</p>
                <p>{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation', ':message') : null }}
                </p>
            </div>
            @endif

            <div class="input-group mb-3">

                {{ Form::email('email', $email ?? old('email'), 
                    ['class' => $errors->has('email') 
                        ? 'form-control is-invalid' 
                        : 'form-control', 'placeholder' => 'Email', 'readonly']) }}

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">

                {{ Form::password('password', 
                    ['class' => $errors->has('password') 
                        ? 'form-control is-invalid' 
                        : 'form-control', 'placeholder' => 'Password']) }}

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">

                {{ Form::password('password_confirmation', 
                    ['class' => $errors->has('password_confirmation') 
                        ? 'form-control is-invalid' 
                        : 'form-control', 'placeholder' => 'Konfirmasi Password']) }}

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Rreset Password') }}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection