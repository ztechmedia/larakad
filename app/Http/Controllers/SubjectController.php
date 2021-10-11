<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subjects = Subject::select('id', 'name');
            return Datatables::of($subjects)
                ->addColumn('action', function ($subject) {
                    return view('datatables._action', [
                        'delete_url' => route('subjects.destroy', $subject->id),
                        'edit_url' => route('subjects.edit', $subject->id),
                        'confirm_message' => 'Apakah anda yakin ingin menghapus Mata Pelajaran : '
                        . $subject->name . ' ? data akan dihapus secara permanen',
                    ]);
                })->make(true);
        }

        $data = [
            'menu' => 'subject',
            'request' => route('subjects.index'),
            'add' => route('subjects.create'),
        ];
        return view('admin.subjects.subjects', $data);
    }

    public function create()
    {
        $data = [
            'menu' => 'subject',
        ];
        return view('admin.subjects.create', $data);
    }

    public function store(Request $request)
    {
        $data = $this->validator($request);
        $subject = Subject::create($data);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Mata Pelajaran berhasil disimpan',
        ]);
    }

    public function edit($id)
    {
        $data = [
            'menu' => 'subject',
            'subject' => Subject::find($id),
        ];

        return view('admin.subjects.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validator($request, $id);

        $teacher = Subject::find($id);
        $teacher->update($data);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Mata Pelajaran berhasil diubah',
        ]);
    }

    public function destroy($id)
    {
        Subject::destroy($id);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Mata Pelajaran berhasil dihapus',
        ]);
    }

    public function validator($request, $id = null)
    {
        $name = $id ? 'required|max:30|unique:subjects,name,' . $id : 'required|max:30|unique:subjects';

        $validatorData = [
            'name' => $name,
        ];

        return Validator::make($request->all(), $validatorData)
        ->setAttributeNames(
            [
                'name' => 'nama mata pelajaran'
            ]
        )->validate();
    }
}
