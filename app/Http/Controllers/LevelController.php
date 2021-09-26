<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Level;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $levels = Level::select('id', 'name', 'stand_for');
            return Datatables::of($levels)
                ->addColumn('action', function ($level) {
                    return view('datatables._action', [
                        'delete_url' => route('levels.destroy', $level->id),
                        'edit_url' => route('levels.edit', $level->id),
                        'confirm_message' => 'Apakah anda yakin ingin menghapus Tingkatan Sekolah : '
                        . $level->name . ' ? data akan dihapus secara permanen',
                    ]);
                })->make(true);
        }

        $data = [
            'menu' => 'levels',
            'submenu' => 'level',
            'request' => route('levels.index'),
            'add' => route('levels.create'),
        ];

        return view('admin.levels.levels', $data);
    }

    public function create()
    {
        $data = [
            'menu' => 'levels',
            'submenu' => 'level',
        ];
        return view('admin.levels.create', $data);
    }

    public function store(Request $request)
    {
        $data = $this->validator($request);
        $level = Level::create($data);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Tingkatan sekolah baru berhasil disimpan',
        ]);
    }

    public function edit($id)
    {
        $data = [
            'menu' => 'levels',
            'submenu' => 'level',
            'level' => Level::find($id),
        ];

        return view('admin.levels.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validator($request, $id);
        $level = Level::find($id);
        $level->update($data);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Tingkatan sekolah berhasil diubah',
        ]);
    }

    public function destroy($id)
    {
        if (Student::where('level_id', $id)->first()) {
            return response()->json([
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Tingkatan sekolah sudah digunakan oleh data siswa',
            ]);
        }

        Level::destroy($id);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Tingkatan sekolah berhasil dihapus',
        ]);
    }

    public function validator($request, $id = null)
    {
        $stand_for = $id ? 'required|unique:levels,stand_for,' . $id : 'required|unique:levels';

        $validatorData = [
            'name' => 'required',
            'stand_for' => $stand_for,
        ];

        return Validator::make($request->all(), $validatorData)
            ->setAttributeNames(
                [
                    'name' => 'nama tingkatan',
                    'stand_for' => 'singkatan',
                ]
            )->validate();
    }
}
