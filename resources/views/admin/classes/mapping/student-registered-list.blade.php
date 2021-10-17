@if($students && count($students) > 0)
<div class="timeline">
    <div class="time-label">
        <span class="bg-red">Daftar Siswa Terdaftar</span>
    </div>
    @foreach ($students as $student)
    <div>
        <i class="fas fa-user bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fas fa-times" onclick="removeStudent('{{ $student->id }}')"></i></span>
            <h3 class="timeline-header"><a>{{ $student->name }}</a></h3>

            <div class="timeline-body">
                <div class="row">
                    <div class="col-6">
                        <table class="custom-table">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $student->name }}</td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>:</td>
                                <td>{{ $student->birth_place.' '.$student->birth_date }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div>
        <i class="fas fa-arrow bg-gray"></i>
    </div>
</div>
@else 
<div class="timeline">
    <div class="time-label">
        <span class="bg-red">Daftar Siswa Terdaftar</span>
    </div>
    <div>
        <i class="fas fa-user bg-blue"></i>
        <div class="timeline-item">
            <span class="time"></span>
            <h3 class="timeline-header"><a>Belum ada siswa di kelas ini</a></h3>

            <div class="timeline-body">
                <div class="row">
                    <div class="col-6">
                        <table class="custom-table">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>:</td>
                                <td>-</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <i class="fas fa-arrow bg-gray"></i>
    </div>
</div>
@endif