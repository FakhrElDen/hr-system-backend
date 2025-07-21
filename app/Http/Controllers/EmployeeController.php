<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Http\Requests\Employee\BulkDeleteEmployeeRequest;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

        $employees = $query->orderBy('created_at', 'DESC')->paginate(5);

        return response()->json([
            'data' => EmployeeResource::collection($employees),
            'meta' => [
                'current_page' => $employees->currentPage(),
                'last_page'    => $employees->lastPage(),
                'per_page'     => $employees->perPage(),
                'total'        => $employees->total(),
            ],
        ], 200);
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        if ($request->hasFile('photo')) {
            $employee->addMediaFromRequest('photo')->toMediaCollection('employees');
        }

        return response()->json($employee, 201);
    }

    public function edit(Employee $employee)
    {
        return response()->json($employee);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        if ($request->hasFile('photo')) {
            $employee->clearMediaCollection('employees');
            $employee->addMediaFromRequest('photo')->toMediaCollection('employees');
        }

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
        Employee::onlyTrashed()->restore();

        return response()->json(null, 200);
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function departments()
    {
        $departments =  Department::get();

        return response()->json($departments, 200);
    }
}
