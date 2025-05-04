<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::with('organization');

        // Apply search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Apply role filter
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        $users = $query->paginate(6);

        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,organization_admin,patient',
            'phone_number' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = new User($validated);
        $user->password = Hash::make($validated['password']);
        $user->save();

        if ($user->role === 'organization_admin') {
            $organization = Organization::create([
                'name' => $user->name . "'s Organization",
                'email' => $user->email,
                'phone' => $user->phone_number,
                'address' => $user->address,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User Added successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,organization_admin,patient',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
