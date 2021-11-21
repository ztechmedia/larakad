<?php

namespace App\Http\Controllers;

use Auth;
use Batch;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Level;
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

    public function sValues()
    {
        return view('student.student_values', ['menu' => 's_values']);
    }

    public function sVClassList($level)
    {
        $levels = Level::find($level)->with('classData')->first();
        $classIds = [];
        $className = [];
        foreach ($levels->classData as $class) {
            $classIds[] = $class->id;
            $className[$class->id] = $class->name;
        }
        $studentId = Auth::user()->student()->first()->id;
        $classes = StudentValue::select('class_id', 'semester', 'year')
                    ->where('student_id', $studentId)
                    ->whereIn('class_id', $classIds)
                    ->groupBy('class_id', 'semester', 'year')
                    ->orderBy('class_id')
                    ->get();

        $fixClass = [];
        foreach ($classes as $key => $class) {
            $fixClass[$className[$class->class_id]][$class->semester] = [
                'year' => $class->year,
                'class_id' => $class->class_id
            ];
        }
        return view('student.class_list', ['classes' => $fixClass, 'student_id' => $studentId]);
    }

    public function detailValues($student_id, $class_id, $semester, $year)
    {
        $values = StudentValue::where('student_id', $student_id)
                    ->where('class_id', $class_id)
                    ->where('semester', $semester)
                    ->where('year', $year)
                    ->with('student')
                    ->with('subject')
                    ->with('classes')
                    ->get();

        $className = ClassData::find($class_id)->name;
        $semester = null;
        $year = null;
        $fixValues = [];
        foreach ($values as $key => $value) {
            if(!$semester) {
                $semester = $value->semester == 'SM1' ? 'Semester 1' : 'Semester 2';
            }
            if(!$year) {
                $year = $value->year;
            }

            $fixValues[] = [
                'subject' => $value->subject->name,
                'value' => $value->value
            ];
        }
        return view('student.detail_values', [
            'className' => $className,
            'semester' => $semester,
            'year' => $year,
            'values' => $fixValues
        ]);
    }
}
