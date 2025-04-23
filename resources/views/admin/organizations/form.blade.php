@php $editing = isset($organization); @endphp

<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $organization->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $organization->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $organization->phone ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $organization->address ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control">
    @if(isset($organization) && $organization->logo)
        <img src="{{  $organization->logo }}" alt="Logo" class="img-thumbnail mt-2" style="height: 100px; width: 100px; object-fit: cover;">
    @endif
</div>

