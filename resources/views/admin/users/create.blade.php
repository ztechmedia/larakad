@extends('layouts.admin.app')

@php
    $alias = ['teacher' => 'Guru', 'student' => 'Murid', 'admin' => 'Admin']   
@endphp

@section('pageTitle', setTitle('Tambah {{ $alias[$level] }}'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah {{ $alias[$level] }}</h1>
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
                            {{ Form::open(['data-url' => route('users.store', $level), 'method' => 'post', 'class' => 'ajax-create']) }}
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