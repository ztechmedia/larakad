<div class="mb-3">
    <button class="btn btn-primary" onclick="newSchedule()">Tambah Jadwal</button>
</div>

@php
   $colsOne = [
       'Senin' => [],
       'Selasa' => [],
       'Rabu' => []
   ];
   $colsTwo = [
       'Kamis' => [],
       'Jumat' => [],
       'Sabtu' => []
   ];

   foreach ($schedules as $schedule) {
       if($schedule->day == 'Senin' || $schedule->day == 'Selasa' || $schedule->day == 'Rabu') {
            $colsOne[$schedule->day][] = [
                'id' => $schedule->id,
                'subject' => $schedule->subject->name,
                'teacher' => $schedule->teacher->name,
                'time' => $schedule->start.' - '.$schedule->end
            ];

       } else {
            $colsTwo[$schedule->day][] = [
                'id' => $schedule->id,
                'subject' => $schedule->subject->name,
                'teacher' => $schedule->teacher->name,
                'time' => $schedule->start.' - '.$schedule->end
            ];
       }
   }
@endphp

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="33%">Senin</th>
            <th width="33%">Selasa</th>
            <th width="33%">Rabu</th>
        </tr>
    </thead>
    <tbody>
        <td width="33%">
            @foreach($colsOne['Senin'] as $senin)
            <div class="sch-container">
                <div class="sch-left">
                    <button class="btn btn-xs" onclick="destroy('{{ $senin['id'] }}')">
                        <i class="fas fa-times" style="color:red"></i>
                    </button>
                    <button class="btn btn-xs" onclick="edit('{{ $senin['id'] }}')">
                        <i class="fas fa-edit" style="color:blue"></i>
                    </button>
                    {{ $senin['subject'].' ('.$senin['teacher'].')' }}
                </div>

                <div class="sch-right">
                    {{ $senin['time'] }}
                </div>
            </div>
            @endforeach
        </td>

        <td width="33%">
            @foreach($colsOne['Selasa'] as $selasa)
            <div class="sch-container">
                <div class="sch-left">
                    <button class="btn btn-xs" onclick="destroy('{{ $selasa['id'] }}')">
                        <i class="fas fa-times" style="color:red"></i>
                    </button>
                    <button class="btn btn-xs" onclick="edit('{{ $selasa['id'] }}')">
                        <i class="fas fa-edit" style="color:blue"></i>
                    </button>
                    {{ $selasa['subject'].' ('.$selasa['teacher'].')' }}
                </div>

                <div class="sch-right">
                    {{ $selasa['time'] }}
                </div>
            </div>
            @endforeach
        </div>

        <td width="33%">
            @foreach($colsOne['Rabu'] as $rabu)
            <div class="sch-container">
                <div class="sch-left">
                    <button class="btn btn-xs" onclick="destroy('{{ $rabu['id'] }}')">
                        <i class="fas fa-times" style="color:red"></i>
                    </button>
                    <button class="btn btn-xs" onclick="edit('{{ $rabu['id'] }}')">
                        <i class="fas fa-edit" style="color:blue"></i>
                    </button>
                    {{ $rabu['subject'].' ('.$rabu['teacher'].')' }}
                </div>

                <div class="sch-right">
                    {{ $rabu['time'] }}
                </div>
            </div>
            @endforeach
        </div>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="33%">Kamis</th>
            <th width="33%">Jumat</th>
            <th width="33%">Sabtu</th>
        </tr>
    </thead>
    <tbody>
        <td width="33%">
            @foreach($colsTwo['Kamis'] as $kamis)
            <div class="sch-container">
                <div class="sch-left">
                    <button class="btn btn-xs" onclick="destroy('{{ $kamis['id'] }}')">
                        <i class="fas fa-times" style="color:red"></i>
                    </button>
                    <button class="btn btn-xs" onclick="edit('{{ $kamis['id'] }}')">
                        <i class="fas fa-edit" style="color:blue"></i>
                    </button>
                    {{ $kamis['subject'].' ('.$kamis['teacher'].')' }}
                </div>

                <div class="sch-right">
                    {{ $kamis['time'] }}
                </div>
            </div>
            @endforeach
        </td>

        <td width="33%">
            @foreach($colsTwo['Jumat'] as $jumat)
            <div class="sch-container">
                <div class="sch-left">
                    <button class="btn btn-xs" onclick="destroy('{{ $jumat['id'] }}')">
                        <i class="fas fa-times" style="color:red"></i>
                    </button>
                    <button class="btn btn-xs" onclick="edit('{{ $jumat['id'] }}')">
                        <i class="fas fa-edit" style="color:blue"></i>
                    </button>
                    {{ $jumat['subject'].' ('.$jumat['teacher'].')' }}
                </div>

                <div class="sch-right">
                    {{ $jumat['time'] }}
                </div>
            </div>
            @endforeach
        </div>

        <td width="33%">
            @foreach($colsTwo['Sabtu'] as $sabtu)
            <div class="sch-container">
                <div class="sch-left">
                    <button class="btn btn-xs" onclick="destroy('{{ $sabtu['id'] }}')">
                        <i class="fas fa-times" style="color:red"></i>
                    </button>
                    <button class="btn btn-xs" onclick="edit('{{ $sabtu['id'] }}')">
                        <i class="fas fa-edit" style="color:blue"></i>
                    </button>
                    {{ $sabtu['subject'].' ('.$sabtu['teacher'].')' }}
                </div>

                <div class="sch-right">
                    {{ $sabtu['time'] }}
                </div>
            </div>
            @endforeach
        </div>
    </tbody>
</table>