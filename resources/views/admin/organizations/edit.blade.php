@extends('admin.adminLayout')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left">Edit Organization</h3>
            <a href="{{ route('organizations.index') }}" class="btn btn-default btn-sm pull-right">Back</a>
        </div>

        <div class="panel-body">
            <form action="{{ route('organizations.update', $organization) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        value="{{ old('name', $organization->name) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email', $organization->email) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="form-control"
                        value="{{ old('phone', $organization->phone) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input
                        type="text"
                        name="address"
                        id="address"
                        class="form-control"
                        value="{{ old('address', $organization->address) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control">

                    @if($organization->logo)
                        <div style="margin-top: 10px; text-align: center;">
                            <img src="{{ asset('storage/' . $organization->logo) }}"
                                 alt="Organization Logo"
                                 class="img-thumbnail"
                                 style="max-width: 150px; height: auto;">
                        </div>
                    @endif
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success">Update Organization</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
