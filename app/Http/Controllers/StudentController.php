<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $students = Student::select('id', 'nis', 'nisn', 'name', 'birth_place', 'birth_date', 'address');
            return Datatables::of($students)
                ->addColumn('birth_date', function ($student) {
                    return $student->birth_place . ', ' . $student->birth_date;
                })
                ->addColumn('action', function ($student) {
                    return view('datatables._action', [
                        'delete_url' => route('students.destroy', $student->id),
                        'edit_url' => route('students.edit', $student->id),
                        'confirm_message' => 'Apakah anda yakin ingin menghapus Murid : '
                        . $student->name . ' ? data akan dihapus secara permanen',
                    ]);
                })->make(true);
        }

        $data = [
            'menu' => 'student',
            'request' => route('students.index'),
            'add' => route('students.create'),
        ];
        return view('admin.students.students', $data);
    }

    public function create()
    {
        $data = [
            'menu' => 'student',
        ];
        return view('admin.students.create', $data);
    }

    public function store(Request $request)
    {
        $this->validator($request);

        $role = Role::where("name", 'student')->first();
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('12345678')
        ];
        $user = User::create($dataUser);
        $user->attachRole($role);

        $data = $request->except('email');
        $data['birth_date'] = revDate($data['birth_date']);
        $data['join_date'] = revDate($data['join_date']);
        $data['user_id'] = $user->id;
        $student = Student::create($data);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Murid berhasil disimpan',
        ]);
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $student->birth_date = revDate($student->birth_date);
        $student->join_date = revDate($student->join_date);
        $data = [
            'menu' => 'student',
            'student' => $student,
        ];

        return view('admin.students.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validator($request, $id);

        $data = $request->all();
        $data['birth_date'] = revDate($data['birth_date']);
        $data['join_date'] = revDate($data['join_date']);
        $student = Student::find($id);
        $student->update($data);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Murid berhasil diubah',
        ]);
    }

    public function destroy($id)
    {

        $student = Student::find($id);
        Student::destroy($student->id);
        User::destroy($student->user_id);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Murid berhasil dihapus',
        ]);
    }

    public function validator($request, $id = null)
    {
        $nis = $id ? 'required|unique:students,nis,' . $id : 'required|unique:students';
        $nisn = $id ? 'required|unique:students,nisn,' . $id : 'required|unique:students';

        $validatorData = [
            'nis' => $nis,
            'nisn' => $nisn,
            'name' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'status' => 'required',
            'child_position' => 'required',
            'address' => 'required',
            'parent_address' => 'required',
            'join_date' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'parent_mobile' => 'required',
            'father_job' => 'required',
            'mother_job' => 'required',
            'level_id' => 'required'
        ];

        if(!$id) {
            $validatorData['email'] = 'required|email|unique:users';
        }

        return Validator::make($request->all(), $validatorData)
        ->setAttributeNames(
            [
                'name' => 'nama lengkap',
                'birth_place' => 'tempat lahir',
                'birth_date' => 'tanggal lahir',
                'child_position' => 'posisi anak',
                'address' => 'alamat',
                'parent_address' => 'alamat orang tua',
                'join_date' => 'tanggal bergabung',
                'father_name' => 'nama ayah',
                'mother_name' => 'nama ibu',
                'parent_mobile' => 'nomor telpon orang tua',
                'father_job' => 'pekerjaan ayah',
                'mother_job' => 'pekerjaan ibu',
                'level_id' => 'tingkatan sekolah',
            ]
        )->validate();
    }
}
