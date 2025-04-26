<?php

namespace App\Http\Controllers\Organization_admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgServiceController extends Controller
{

    public function index(Request $request)
    {
        $organizationId = auth()->user()->organization->id;

        $query = DB::table('organization_service')
            ->join('services', 'organization_service.service_id', '=', 'services.id')
            ->join('employees', 'organization_service.employee_id', '=', 'employees.id')
            ->where('organization_service.organization_id', $organizationId)
            ->select(
                'organization_service.id',
                'services.name as service_name',
                'employees.name as employee_name',
                'organization_service.price'
            );

        if ($request->filled('service_id')) {
            $query->where('services.id', $request->service_id);
        }

        if ($request->filled('employee_id')) {
            $query->where('employees.id', $request->employee_id);
        }

        $services = $query->paginate(4);

        $allServices = Service::all();
        $allEmployees = Employee::where('organization_id', $organizationId)->get();

        return view('organization_admin.services.index', compact('services', 'allServices', 'allEmployees'));
    }

    public function create()
    {
        $organizationId = auth()->user()->organization->id;
        $services = Service::all();
        $employees = Employee::where('organization_id', $organizationId)->get();

        return view('organization_admin.services.create', compact('services', 'employees'));
    }

    public function store(Request $request)
    {
        $organizationId = auth()->user()->organization->id;

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'employee_id' => 'required|exists:employees,id',
            'price' => 'required|numeric|min:0',
        ]);

        DB::table('organization_service')->insert([
            'organization_id' => $organizationId,
            'service_id' => $request->service_id,
            'employee_id' => $request->employee_id,
            'price' => $request->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('organization_admin.services.index')->with('success', 'Service assigned successfully!');
    }

    public function edit($id)
    {
        $organizationId = auth()->user()->organization->id;

        $entry = DB::table('organization_service')
            ->where('organization_service.organization_id', $organizationId)
            ->where('organization_service.id', $id)
            ->first();

        if (!$entry) {
            abort(404);
        }

        $services = Service::all();
        $employees = Employee::where('organization_id', $organizationId)->get();

        return view('organization_admin.services.edit', compact('entry', 'services', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $organizationId = auth()->user()->organization->id;

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'employee_id' => 'required|exists:employees,id',
            'price' => 'required|numeric|min:0',
        ]);

        DB::table('organization_service')
            ->where('organization_id', $organizationId)
            ->where('id', $id)
            ->update([
                'service_id' => $request->service_id,
                'employee_id' => $request->employee_id,
                'price' => $request->price,
                'updated_at' => now(),
            ]);

        return redirect()->route('organization_admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function show($id)
    {
        $organizationId = auth()->user()->organization->id;

        $service = DB::table('organization_service')
            ->where('organization_service.id', $id)
            ->where('organization_service.organization_id', $organizationId)
            ->join('services', 'organization_service.service_id', '=', 'services.id')
            ->select(
                'organization_service.*',
                'services.name as service_name'
            )
            ->first();

        if (!$service) {
            return redirect()->route('organization_admin.services.index')->with('error', 'Service not found.');
        }

        $employee = DB::table('employees')
            ->where('id', $service->employee_id)
            ->first();

        return view('organization_admin.services.show', compact('service', 'employee'));
    }



}
