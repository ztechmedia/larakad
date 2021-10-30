<div class="timeline">
    <div class="time-label">
        <span class="bg-red">Siswa {{ $class->level->name }} Kelas {{ $class->name }}</span>
    </div>
    @if(isset($students) && count($students) > 0)
        @foreach ($students as $student)
        <div>
            <i class="fas fa-user bg-blue"></i>
            <div class="timeline-item">
                <span class="time"></span>
                <h3 class="timeline-header"><a></a></h3>

                <div class="timeline-body">
                    <table class="custom-table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $student->student->name }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td>{{ $class->name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="timeline-footer">
                    <button class="btn btn-primary btn-sm" onclick="inputValues('{{ $student->student->id }}', '{{ $class->id }}', '{{ $student->student->name }}')">Input Nilai</button>
                    <button class="btn btn-warning btn-sm" onclick="detailValues('{{ $student->student->id }}', '{{ $class->id }}', '{{ $student->student->name }}')">Detail</button>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <div>
        <i class="fas fa-user bg-blue"></i>
        <div class="timeline-item">
            <span class="time"></span>
            <h3 class="timeline-header"><a></a></h3>

            <div class="timeline-body">
                <table class="custom-table">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                </table>
            </div>
            <div class="timeline-footer">
                <button class="btn btn-primary btn-sm" disabled>Input Nilai</button>
                <button class="btn btn-warning btn-sm" disabled>Detail</button>
            </div>
        </div>
    </div>
    @endif
    <div>
        <i class="fas fa-arrow bg-gray"></i>
    </div>
</div>