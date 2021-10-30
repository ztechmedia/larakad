<?php

namespace App\Http\Controllers;

use Auth;
use Batch;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\ClassData;
use App\Models\MappingClass;
use App\Models\StudentValue;
use Illuminate\Http\Request;

class StudentValuesController extends Controller
{
    public function index()
    {
        return view('admin.student_values.values', ['menu' => 'student_values']);
    }

    public function studentList($classId, $year)
    {
        $students = MappingClass::where(['class_id' => $classId, 'year' => $year])
            ->with('student')
            ->get();
        $class = ClassData::find($classId)->with('level')->first();
        return view('admin.student_values.student-list', ['students' => $students, 'class' => $class]);
    }

    public function inputValues($studentId, $classId, $year, $semester, $mode)
    {
        $subjects = Schedule::select('subject_id', 'class_id', 'year', 'semester', 'teacher_id')
            ->where(['class_id' => $classId, 'year' => $year, 'semester' => $semester])
            ->with('subject')
            ->with('classes')
            ->groupBy('subject_id', 'class_id', 'year', 'semester', 'teacher_id')
            ->get();
        $values = StudentValue::where(['student_id' =>$studentId, 'class_id' => $classId, 'year' => $year, 'semester' => $semester])->get();
        $sValues = [];
        foreach ($values as $value) {
            $sValues[$value->subject_id] = $value->value; 
        }

        $teacher_id = null;
        if(Auth::user()->hasRole('teacher')) {
            $teacher_id = Teacher::where('user_id', Auth::user()->id)->first()->id;
        }

        return view('admin.student_values.input-values', [
            'subjects' => $subjects,
            'studentId' => $studentId,
            'classId' => $classId,
            'year' => $year,
            'semester' => $semester,
            'subvalues' => $sValues,
            'mode' => $mode,
            'teacher_id' => $teacher_id
        ]);
    }

    public function storeValues(Request $request)
    {
        $insert = array();
        $update = array();
        foreach ($request->subject as $key => $value) {
            $check = StudentValue::where([
                'student_id' => $request->student_id,
                'class_id' => $request->class_id,
                'year' => $request->year,
                'semester' => $request->semester,
                'subject_id' => $key])->first();

            if ($check) {
                $update[] = [
                    'id' => $check->id,
                    'value' => $value,
                    'created_by' => Auth::user()->name,
                ];
            } else {
                $insert[] = [
                    'student_id' => $request->student_id,
                    'class_id' => $request->class_id,
                    'year' => $request->year,
                    'semester' => $request->semester,
                    'subject_id' => $key,
                    'value' => $value,
                    'created_by' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

        }
        StudentValue::insert($insert);
        Batch::update(new StudentValue, $update, 'id');
        return response()->json(['status' => 'success', 'message' => 'Berhasil input nilai']);
    }
}
