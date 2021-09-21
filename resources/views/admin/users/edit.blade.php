@extends('layouts.admin.app')

@php
    $alias = ['teacher' => 'Guru', 'student' => 'Murid', 'admin' => 'Admin']   
@endphp

@section('pageTitle', setTitle('Edit {{ $alias[$level] }}'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit {{ $alias[$level] }}</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            {{ Form::model($user, ['data-url' => route('users.update', $user->id), 'method' => 'put', 'class' => 'ajax-update']) }}
                            @include('admin.users._form')
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/errorHandler.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
@endsection