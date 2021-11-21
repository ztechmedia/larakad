<div class="row">
    @foreach($classes as $key1 => $value1)
    <div class="col-12">
        <div class="card card-primary active ">
            <div class="card-header">
                <h3 class="card-title">{{ "Kelas $key1" }}</h3>
            </div>
            @foreach ($value1 as $key2 => $value2)
            <div class="card-body" id="{{ "card-$key2" }}">
                <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link text-black" onclick="detailValue('{{ $student_id }}', '{{ $value2['class_id'] }}', '{{ $key2 }}', '{{ $value2['year'] }}')">
                        {{ $key2 == 'SM1' ? 'Semester 1' : 'Semester 2' }} ( {{ $value2['year']}} )
                      </a>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>