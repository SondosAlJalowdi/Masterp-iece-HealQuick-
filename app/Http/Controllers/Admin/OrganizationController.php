<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\User;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $query = Organization::with('user');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('address', 'like', "%$search%");
        }

        $organizations = $query->paginate(6);

        return view('admin.organizations.index', compact('organizations'));
    }


    public function create()
    {
        return view('admin.organizations.create');
    }

    public function show(Organization $organization)
    {
        return view('admin.organizations.show', compact('organization'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:organizations',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Organization::create($validated);
        return redirect()->route('organizations.index')->with('success', 'Organization created!');
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:organizations,email,' . $organization->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $organization->update($validated);
        return redirect()->route('organizations.index')->with('success', 'Organization updated!');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return redirect()->route('organizations.index')->with('success', 'Organization deleted!');
    }
}


