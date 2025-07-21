<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\BulkDeleteEmployeeRequest;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with('department');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('hired_at')) {
            $query->whereDate('hired_at', $request->hired_at);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $employees = $query->paginate(5);

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
