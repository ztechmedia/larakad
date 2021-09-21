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

            {{ Form::open(['url' => route('password.email'), 'method' => 'post']) }}

            @if ($errors->has('email'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Ops..!</h5>
                <p>{{ $errors->has('email') ? $errors->first('email', ':message') : null }}</p>
            </div>
            @endif

            <div class="input-group mb-3">
                {{ Form::email('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Email']) }}
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <p class="mb-1">
                        <a href={{ route('login') }}>{{ __('Login') }}</a>
                    </p>
                </div>

                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Kirim Link') }}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
