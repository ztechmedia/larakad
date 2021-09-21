@extends('layouts.auth.app')

@section('pageTitle', setTitle('Login'))

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a>{{__('SDN')}} <b>{{ __('1') }}</b> {{ __('CIMUNING') }}</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Selamat Datang') }}</p>

            {{ Form::open(['url' => route('login'), 'method' => 'post']) }}

            @if ($errors->has('email') || $errors->has('password'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Ops..!</h5>
                <p>{{ $errors->has('email') ? $errors->first('email', ':message') : null }}</p>
                <p>{{ $errors->has('password') ? $errors->first('password', ':message') : null }}</p>
            </div>
            @endif

            <div class="input-group mb-3">

                {{ Form::email('email', null, 
                    ['class' => $errors->has('email') 
                        ? 'form-control is-invalid' 
                        : 'form-control', 'placeholder' => 'Email']) }}
                
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">

                {{ Form::password('password', 
                    ['class' => $errors->has('email') 
                        ? 'form-control is-invalid' 
                        : 'form-control', 'placeholder' => 'Password']) }}
                
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Ingat Saya') }}
                        </label>
                    </div>
                </div>

                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </div>
            </div>
            </form>
            @if (Route::has('password.request'))
            <p class="mb-1">
                <a href={{ route('password.request') }}>{{ __('Lupa Password') }}</a>
            </p>
            @endif
        </div>
    </div>
</div>
@endsection