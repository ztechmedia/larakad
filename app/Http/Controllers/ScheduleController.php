<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassData;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'menu' => 'schedule',
            'request' => route('schedules.index'),
            'add' => route('schedules.create'),
        ];
        return view('admin.schedules.schedules', $data);
    }

    public function classlist($level)
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
}
