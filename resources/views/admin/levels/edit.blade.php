@extends('layouts.admin.app')

@section('pageTitle', setTitle('Edit Tingkatan Sekolah'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Tingkatan Sekolah</h1>
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
                            {{ Form::model($level, ['data-url' => route('levels.update', $level->id), 'method' => 'put', 'class' => 'ajax-update']) }}
                            @include('admin.levels._form')
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