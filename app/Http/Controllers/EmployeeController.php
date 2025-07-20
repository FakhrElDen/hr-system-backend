<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\BulkDeleteEmployeeRequest;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->paginate(10);
        return response()->json($employees, 201);
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        return response()->json($employee, 201);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(null, 204);
    }

    public function bulkDelete(BulkDeleteEmployeeRequest $request)
    {
        Employee::whereIn('id', $request->ids)->delete();
        return response()->json(null, 204);
    }

    public function restore()
    {
        //
    }
}
