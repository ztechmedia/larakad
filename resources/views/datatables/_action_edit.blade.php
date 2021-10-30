@if(Auth::user()->hasRole('admin'))
<a title="Edit" class="btn btn-info btn-xs" href="{{ $edit_url }}"><i class="fas fa-pencil-alt"></i></a>
@else
<a title="Edit" class="btn btn-default btn-xs" style="background: silver"><i class="fas fa-pencil-alt"></i></a>
@endif