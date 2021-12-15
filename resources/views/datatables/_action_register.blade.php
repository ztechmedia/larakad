@if(Auth::user()->hasRole('admin'))
<a title="Konfirmasi" class="btn btn-success btn-xs ajax-confirm" data-url="{{ $confirm }}" data-message="Yakin akan konfirmasi ?">
    <i class="fas fa-check"></i>
</a>
@endif