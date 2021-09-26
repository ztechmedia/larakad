{{ Form::model($schedule, ['data-url' => route('schedules.update', $schedule->id), 'data-response' => 'custom', 'method' => 'put', 'class' => 'ajax-update']) }}

<div class="modal-body">
    @include('admin.schedules._form')
</div>

<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
    {!! Form::submit('Simpan', ['class' => 'btn-submit btn btn-primary']) !!}
</div>

{{ Form::close() }}