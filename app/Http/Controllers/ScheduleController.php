<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassData;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;
use Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.schedules.schedules', ['menu' => 'schedule']);
    }

    public function classes($level)
    {
        $classes = ClassData::where('level_id', $level)->get();
        $html = "";
        foreach ($classes as $key => $class) {
            $html .= "<option value='$class->id'>$class->name</option>";
        }

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'classes' => $html
        ]);
    }

    public function list($class, $year, $semester)
    {
        $schedules = Schedule::where(['class_id' =>  $class, 'year' => $year, 'semester' => $semester])
                    ->with('subject')
                    ->with('teacher')
                    ->with('classes')
                    ->get();
        return view('admin.schedules.schedule-list', ['schedules' => $schedules]);
    }

    public function create($class, $year, $semester)
    {
        return view('admin.schedules.create', ['class_id' => $class, 'year' => $year, 'semester' => $semester]);
    }

    public function store(Request $request)
    {
        $this->validator($request);
        $check = Schedule::where([
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'class_id' => $request->class_id,
            'day' => $request->day,
            'start' => $request->start,
            'end' => $request->end,
            'semester' => $request->semester,
            'year' => $request->year
        ])->first();

        $start = explode(':', $request->start);
        $end = explode(':', $request->end);

        if($end <= $start) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Waktu Berakhir harus lebih besar dari Waktu Mulai'
            ]);
        }
        
        if($check) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Jadwal sudah ada'
            ]);
        }
        $request->merge(['created_by' => Auth::user()->id]);
        Schedule::create($request->all());
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Berhasil menambah jadwal'
        ]); 
    }

    public function destroy($id)
    {
        Schedule::destroy($id);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Jadwal berhasil dihapus'
        ]);
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view('admin.schedules.edit', ['schedule' => $schedule]);
    }

    public function update(Request $request, $id)
    {
        $this->validator($request);

        $schedule = Schedule::where([
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'class_id' => $request->class_id,
            'day' => $request->day,
            'start' => $request->start,
            'end' => $request->end,
            'semester' => $request->semester,
            'year' => $request->year
        ])->first();

        $start = explode(':', $request->start);
        $end = explode(':', $request->end);

        if($end <= $start) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Waktu Berakhir harus lebih besar dari Waktu Mulai'
            ]);
        }
        
        if($schedule && $schedule->id != $id) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Jadwal sudah ada'
            ]);
        }

        $request->merge(['created_by' => Auth::user()->id]);

        if($schedule) {
            $schedule->update($request->all());
        } else {
            Schedule::where('id', $id)->first()->update($request->all());
        }

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Berhasil mengubah jadwal'
        ]);
    }

    public function validator($request)
    {
        return Validator::make($request->all(), [
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
            'day' => 'required',
            'start' => 'required',
            'end' => 'required',
            'semester' => 'required',
            'year' => 'required',
        ])->setAttributeNames(
            [
                'subject_id' => 'mata pelajaran',
                'teacher_id' => 'guru',
                'class_id' => 'kelas',
                'day' => 'hari',
                'start' => 'waktu mulai',
                'end' => 'waktu berakhir',
                'semester' => 'semester',
                'year' => 'tahun',
            ]
        )->validate();
    }
}
