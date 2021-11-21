<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $totalAdmin = Role::where('name', 'admin')->first()->users()->get()->count();
            $totalTeacher = Role::where('name', 'teacher')->first()->users()->get()->count();
            $totalStudent = Role::where('name', 'student')->first()->users()->get()->count();
            $data = [
                'menu' => 'home',
                'totalAdmin' => $totalAdmin,
                'totalTeacher' => $totalTeacher,
                'totalStudent' => $totalStudent
            ];
            
            return view('home', $data);
        } else {
            return redirect('/s_values');
        }
    }
}
