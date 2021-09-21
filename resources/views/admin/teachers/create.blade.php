@extends('layouts.admin.app')

@section('pageTitle', setTitle('Tambah Guru'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Guru</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{ Form::open(['data-url' => route('teachers.store'), 'method' => 'post', 'class' => 'ajax-create']) }}
                    @include('admin.teachers._form')
                    {{ Form::close() }}
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