<?php

namespace App\Http\Controllers;

use App\Models\ClassData;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'menu' => 'levels',
            'submenu' => 'class',
        ];
        return view('admin.classes.classes', $data);
    }

    public function classList($level)
    {
        $classes = ClassData::where('level_id', $level)->get();
        $lists = [];
        foreach($classes as $class) {
            $classExp = explode('-', $class->name);
            $lists[$classExp[0]][] = [
                'id' => $class->id,
                'class' => $classExp[1]
            ];
        }
        $data = [
            'classes' => $classes,
            'lists' => $lists
        ];
        return view('admin.classes.class-list', $data);
    }

    public function create($level)
    {
        $classes = $this->getClasses($level);
        $data = [
            'level' => $level,
            'classes' => $classes,
        ];
        return view('admin.classes.create', $data);
    }

    public function store(Request $request)
    {
        $this->validator($request);
        $name = $request->name.'-'.$request->subclass;
        $checkClass = ClassData::where(['level_id' => $request->level_id, 'name' => $name])->get();
        if(count($checkClass) > 0) {
            return response()->json([
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Kelas sudah digunakan',
            ]);
        }

        $data = [
            'name' => $name,
            'level_id' => $request->level_id
        ];

        $class = ClassData::create($data);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Kelas berhasil disimpan',
            'class' => $request->name
        ]);
    }

    public function edit($id)
    {
        $class = ClassData::find($id);
        $classes = $this->getClasses($class->level_id);
        $namePart = explode('-', $class->name);
        $data = [
            'class' => [
                'id' => $class->id,
                'name' => $namePart[0],
                'subclass' => $namePart[1]
            ],
            'classes' => $classes
        ];

        return view('admin.classes.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validator($request);
        $class = ClassData::find($id);
        $name = $request->name."-".$request->subclass;

        if($name === $class->name) {
            return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Kelas berhasil diubah',
                'class' => $request->name
            ]);
        } else {
            $hasName = ClassData::checkNameForUpdate($id, $class->level_id, $name);
            if(!$hasName) {
                return response()->json([
                    'status' => 'failed',
                    'status_code' => 200,
                    'message' => 'Kelas gagal diubah'
                ]);
            } else {
                $class->name = $name;
                $class->update();

                return response()->json([
                    'status' => 'success',
                    'status_code' => 200,
                    'message' => 'Kelas berhasil diubah',
                    'class' => $request->name
                ]);
            }
        }
       
        
        $class->update(['name' => $name]);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Kelas berhasil diubah',
            'class' => $request->name
        ]);
    }

    public function destroy($id)
    {
        $class = explode('-', ClassData::find($id)->name);
        ClassData::destroy($id);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Kelas berhasil dihapus',
            'class' => $class[0]
        ]);
    }

    public function getClasses($level)
    {
        $classes = classLevel();
        $level = Level::find($level);

        if ($level->stand_for === 'SD') {
            $classes = array_slice($classes, 0, 6);
        } else if ($level->stand_for === 'SMP') {
            $classes = array_slice($classes, 6, 3);
        } else if ($level->stand_for === 'SMA' || $level->stand_for === 'SMK') {
            $classes = array_slice($classes, 9, 3);
        }

        return $classes;
    }

    public function validator($request, $id = null)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'subclass' => 'required|max:2',
        ])->setAttributeNames(
            [
                'name' => 'tingkatan kelas',
                'subclass' => 'kelompok kelas',
            ]
        )->validate();
    }
}
