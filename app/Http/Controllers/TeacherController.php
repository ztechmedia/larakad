<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $teachers = Teacher::select('id', 'nip', 'name', 'address', 'mobile', 'last_education');
            return Datatables::of($teachers)
                ->addColumn('action', function ($teacher) {
                    return view('datatables._action', [
                        'delete_url' => route('teachers.destroy', $teacher->id),
                        'edit_url' => route('teachers.edit', $teacher->id),
                        'confirm_message' => 'Apakah anda yakin ingin menghapus Guru : '
                        . $teacher->name . ' ? data akan dihapus secara permanen',
                    ]);
                })->make(true);
        }

        $data = [
            'menu' => 'teacher',
            'request' => route('teachers.index'),
            'add' => route('teachers.create'),
        ];
        return view('admin.teachers.teachers', $data);
    }

    public function create()
    {
        $data = [
            'menu' => 'teacher',
        ];
        return view('admin.teachers.create', $data);
    }

    public function store(Request $request)
    {
        $this->validator($request);

        $role = Role::where("name", 'teacher')->first();
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('12345678'),
        ];
        $user = User::create($dataUser);
        $user->attachRole($role);
        $data = $request->except('email');
        $data['user_id'] = $user->id;
        $teacher = Teacher::create($data);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Guru berhasil disimpan',
        ]);
    }

    public function edit($id)
    {
        $data = [
            'menu' => 'teacher',
            'teacher' => Teacher::find($id),
        ];

        return view('admin.teachers.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validator($request, $id);

        $teacher = Teacher::find($id);
        $teacher->update($request->all());

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Guru berhasil diubah',
        ]);
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        Teacher::destroy($teacher->id);
        User::destroy($teacher->user_id);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Guru berhasil dihapus',
        ]);
    }

    public function validator($request, $id = null)
    {
        $nip = $id ? 'required|unique:teachers,nip,' . $id : 'required|unique:teachers';

        $validatorData = [
            'nip' => $nip,
            'name' => 'required|max:30',
            'address' => 'required',
            'mobile' => 'required|max:15',
            'last_education' => 'required|max:100',
        ];

        if (!$id) {
            $validatorData['email'] = 'required|email|unique:users';
        }

        return Validator::make($request->all(), $validatorData)
        ->setAttributeNames(
            [
                'name' => 'nama lengkap',
                'address' => 'alamat',
                'mobile' => 'nomor telpon',
                'last_education' => 'pendidikan terakhir',
            ]
        )->validate();
    }
}
