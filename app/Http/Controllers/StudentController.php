<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // GET all students
    public function index()
    {
        return response()->json(Student::all());
    }

    // GET single student by ID
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json($student);
    }

    // POST create new student
    public function store(Request $request)
    {
        $student = Student::create([
            'name' => $request->name,
            'course' => $request->course,
            'age' => $request->age,
        ]);

        return response()->json([
            'message' => 'Student added successfully',
            'data' => $student
        ], 201);
    }

    // PUT update whole student data
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $student->update([
            'name' => $request->name,
            'course' => $request->course,
            'age' => $request->age,
        ]);

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student
        ]);
    }

    // PATCH update specific fields only
    public function patch(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $student->update($request->only([
            'name',
            'course',
            'age'
        ]));

        return response()->json([
            'message' => 'Student partially updated',
            'data' => $student
        ]);
    }

    // DELETE student
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }
}