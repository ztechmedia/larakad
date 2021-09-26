{{ Form::open(['data-url' => route('schedules.store'), 'data-response' => 'custom', 'method' => 'post', 'class' => 'ajax-create']) }}

<div class="modal-body">
    <input type="hidden" name="class_id" value="{{ $class_id }}">
    @include('admin.schedules._form')
</div>

<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
    {!! Form::submit('Simpan', ['class' => 'btn-submit btn btn-primary']) !!}
</div>

{{ Form::close() }}