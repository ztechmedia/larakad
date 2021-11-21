<div class="row">
    <h4>Daftar Nilai Kelas {{ $className }} {{ $semester }} Tahun Ajaran {{ $year }}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mata Pelajara</th>
                <th>Nilai</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($values as $value)
            <tr>
                <td>{{ $value['subject'] }}</td>
                <td>{{ $value['value'] }}</td>
            </tr>
            @endforeach
           
        </tbody>
    </table>
</div>