@php $editing = isset($user); @endphp

<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div class="form-group">
    <label>Role</label>
    <select name="role" class="form-control" required>
        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="organization_admin" {{ old('role', $user->role ?? '') == 'organization_admin' ? 'selected' : '' }}>Organization Admin</option>
        <option value="patient" {{ old('role', $user->role ?? '') == 'patient' ? 'selected' : '' }}>Patient</option>
    </select>
</div>

<div class="form-group">
    <label>Phone</label>
    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number ?? '') }}" required>
</div>

<div class="form-group">
    <label>Address</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $user->address ?? '') }}" required>
</div>

@if(!$editing)
<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
</div>
@endif
