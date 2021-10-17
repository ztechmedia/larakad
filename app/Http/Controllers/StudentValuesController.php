<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentValuesController extends Controller
{
    public function index()
    {
        return view('admin.student_values.values', ['menu' => 'student_values']);
    }
}
