@extends('layouts.admin.app')

@section('pageTitle', setTitle('Tambah Murid'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Murid</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{ Form::open(['data-url' => route('students.store'), 'method' => 'post', 'class' => 'ajax-create']) }}
                    @include('admin.students._form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection