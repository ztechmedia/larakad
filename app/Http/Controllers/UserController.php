<?php

namespace App\Http\Controllers;

use Auth;
use Datatables;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $level)
    {
        if ($request->ajax()) {
            $users = Role::where('name', $level)->first()->users()->get();
            return Datatables::of($users)
                ->addColumn('role', function ($user) {
                    return ucfirst($user->roles->first()->name);
                })
                ->addColumn('action', function ($user) use ($level) {
                    $action = $level === 'admin' ? 'datatables._action' : 'datatables._action_edit';
                    return view($action, [
                        'delete_url' => route('users.destroy', $user->id),
                        'edit_url' => route('users.edit', ['id' => $user->id, 'level' => $level]),
                        'confirm_message' => 'Apakah anda yakin ingin menghapus User : '
                        . $user->name . ' ? data akan dihapus secara permanen',
                    ]);
                })->make(true);
        }

        $data = [
            'menu' => 'users',
            'submenu' => $level,
            'request' => route('users.index', $level),
            'add' => route('users.create', $level),
            'level' => $level,
        ];

        return view('admin.users.users', $data);
    }

    public function create()
    {
        $data = [
            'menu' => 'users',
            'submenu' => 'admin',
            'level' => 'admin',
        ];
        return view('admin.users.create', $data);
    }

    public function store(Request $request)
    {
        $data = $this->validator($request);

        $data['password'] = bcrypt($data['password']);
        $role = Role::where("name", 'admin')->first();
        $user = User::create($data);
        $user->attachRole($role);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Pengguna baru berhasil disimpan',
        ]);
    }

    public function edit($id, $level)
    {
        $data = [
            'menu' => 'users',
            'submenu' => $level,
            'level' => $level,
            'user' => User::find($id),
        ];

        return view('admin.users.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validator($request, $id);

        $user = User::find($id);
        $user->update($data);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Pengguna berhasil diubah',
        ]);
    }

    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            return response()->json([
                'status' => 'error',
                'status_code' => 400,
                'message' => 'Tidak dapat menghapus diri sendiri',
            ]);
        }

        User::destroy($id);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Pengguna berhasil dihapus',
        ]);
    }

    public function validator($request, $id = null)
    {
        $email = $id ? 'required|email|unique:users,email,' . $id : 'required|email|unique:users';

        $validatorData = [
            'name' => 'required',
            'email' => $email,
        ];

        if (!$id) {
            $validatorData['password'] = 'required|confirmed|min:8';
            $validatorData['password_confirmation'] = 'required';
        }

        return Validator::make($request->all(), $validatorData)
            ->setAttributeNames(
                [
                    'name' => 'nama lengkap',
                    'password_confirmation' => 'konfirmasi password',
                ]
            )->validate();
    }
}
