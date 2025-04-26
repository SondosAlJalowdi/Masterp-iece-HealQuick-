<?php

namespace App\Http\Controllers\Organization_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class OrgEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $organizationId = auth()->user()->organization->id;

        $query = Employee::where('organization_id', $organizationId);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%")
                  ->orWhere('position', 'LIKE', "%$search%");
            });
        }

        $employees = $query->latest()->paginate(4);

        return view('organization_admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('organization_admin.employees.create');
    }

    public function store(Request $request)
    {
        $organizationId = auth()->user()->organization->id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['organization_id'] = $organizationId;

        Employee::create($validated);

        return redirect()->route('organization_admin.employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $org_employee)
    {
        return view('organization_admin.employees.edit', ['employee' => $org_employee]);
    }

    public function update(Request $request, Employee $org_employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $org_employee->id,
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $org_employee->update($validated);

        return redirect()->route('organization_admin.employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $org_employee)
    {
        $org_employee->delete();
        return redirect()->route('organization_admin.employees.index')->with('success', 'Employee deleted successfully.');
    }
}
