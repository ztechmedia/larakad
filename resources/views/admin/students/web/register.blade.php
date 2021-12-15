@extends('layouts.web')

@section('pageTitle', setTitle('Form Registrasi Murid Baru'))

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Siswa Baru</h1>
            </div>

        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{ Form::open(['data-url' => route('form.registrasi_submit'), 'method' => 'post', 'class' => 'ajax-create']) }}
                    @include('admin.students._form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection