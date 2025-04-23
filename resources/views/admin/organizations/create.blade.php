@extends('admin.adminLayout')

@section('content')
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Add Organization</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('organizations.store') }}" method="POST">
                @csrf
                @include('admin.organizations.form')
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
