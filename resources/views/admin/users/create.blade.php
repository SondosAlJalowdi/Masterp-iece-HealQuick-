@extends('admin.adminLayout')

@section('content')
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Add User</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                @include('admin.users.form')
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
