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
            'classes' => $html
        ]);
    }

    public function list($class)
    {
        $schedules = Schedule::where('class_id', $class)->get();
        return view('admin.schedules.schedule-list', ['schedules' => $schedules]);
    }

    public function create($class)
    {
        return view('admin.schedules.create', ['class_id' => $class]);
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
            'end' => $request->end
        ])->first();
        
        if($check) {
            return response()->json([
                'status' => 'duplicate',
                'message' => 'Jadwal sudah ada'
            ]);
        }
        $request->merge(['created_by' => Auth::user()->id]);
        Schedule::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambah jadwal'
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
        ])->setAttributeNames(
            [
                'subject_id' => 'mata pelajaran',
                'teacher_id' => 'guru',
                'class_id' => 'kelas',
                'day' => 'hari',
                'start' => 'waktu mulai',
                'end' => 'waktu berakhir',
            ]
        )->validate();
    }
}
