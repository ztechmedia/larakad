@if(Auth::user()->hasRole('admin'))
<a title="Edit" class="btn btn-info btn-xs" href="{{ $edit_url }}"><i class="fas fa-pencil-alt"></i></a>
<a title="Hapus" class="btn btn-danger btn-xs ajax-delete" data-url="{{ $delete_url }}" data-message="{{ $confirm_message }}">
    <i class="fas fa-trash"></i>
</a>
@else
<a style="background: silver" title="Edit" disabled class="btn btn-default btn-xs"><i class="fas fa-pencil-alt"></i></a>
<a style="background: silver" title="Hapus" class="btn btn-default btn-xs">
    <i class="fas fa-trash"></i>
</a>
@endif
