@if($students && count($students) > 0)
<div class="timeline">
    <div class="time-label">
        <span class="bg-red">Daftar Siswa</span>
    </div>
    @foreach ($students as $student)
    <div>
        <i class="fas fa-user bg-blue"></i>
        <div class="timeline-item">
            <span class="time"></span>
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
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $student->address }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="custom-table">
                            <tr>
                                <td>No. Telp</td>
                                <td>:</td>
                                <td>{{ $student->mobile ? $student->mobile : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Nama Ayah</td>
                                <td>:</td>
                                <td>{{ $student->father_name }}</td>
                            </tr>
                            <tr>
                                <td>Nama Ibu</td>
                                <td>:</td>
                                <td>{{ $student->mother_name }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="timeline-footer">
                <a class="btn btn-primary btn-sm" onclick="selectStudent('{{ $student->id }}')">Masukan Siswa Ke Dalam Kelas</a>
            </div>
        </div>
    </div>
    @endforeach
    <div>
        <i class="fas fa-arrow bg-gray"></i>
    </div>
</div>
@else 
<p>Data siswa yang diminta kosong</p>
@endif