<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassData;
use App\Models\Schedule;

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
        dd($request->day);
    }
}
