<?php

namespace App\Exports;

use App\Enums\EmployeeStatus;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class EmployeesExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithMapping
{
    public function collection()
    {
        return Employee::all(['id', 'name', 'email', 'phone', 'position', 'salary', 'hired_at', 'status']);
    }

    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->name,
            $employee->email,
            $employee->phone,
            $employee->position,
            $employee->salary,
            $employee->hired_at,
            $employee->status == EmployeeStatus::ACTIVE ?
                EmployeeStatus::getStringValue(EmployeeStatus::ACTIVE) :
                EmployeeStatus::getStringValue(EmployeeStatus::IN_ACTIVE),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Position',
            'Salary',
            'Hired At',
            'Status',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 40,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
