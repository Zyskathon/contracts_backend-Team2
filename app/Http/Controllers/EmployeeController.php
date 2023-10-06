<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return EmployeeResource::Collection($employees);
    }

    public function store(Request $request)
    {
        // Validate and store the new resource
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
        ]);

        Employee::create($validatedData);

        return response(['message' => 'created successfully'], 201);
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return new EmployeeResource($employee);
    }

    public function destroy($id)
    {
        $item = Employee::find($id);
        $item->delete();

        return response(['message' => 'deleted successfully'], 201);
    }
}
