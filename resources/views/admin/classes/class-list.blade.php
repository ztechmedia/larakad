<div class="row">
    <div class="col-12">
        <a class="btn btn-primary mb-2" onclick="add()">Tambah Kelas</a>
    </div>

    @foreach($lists as $key => $list)
    <div class="col-12">
        <div class="card card-primary collapsed-card">
            <div class="card-header">
                <h3 class="card-title">{{ "Kelas $key" }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body" id="{{ "card-$key" }}">
                <ul class="nav flex-column">
                    @foreach($list as $class)
                    <li class="nav-item">
                      <a class="nav-link text-black">
                        {{ "Kelas ".$key."-".$class['class'] }} 
                        <span onclick="edit('{{ $class['id'] }}')" class="float-right badge bg-info ml-1"><i class="fas fa-edit"></i></span>
                        <span onclick="destroy('{{ $class['id'] }}')" class="float-right badge bg-danger"><i class="fas fa-trash"></i></span>
                      </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>