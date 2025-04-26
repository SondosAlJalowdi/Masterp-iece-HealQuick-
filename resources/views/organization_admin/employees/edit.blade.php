@extends('organization_admin.orgAdminLayout')

@section('content')
<div class="content-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title"><i class="fa fa-user-edit"></i> Edit Employee</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('organization_admin.employees.index') }}" class="btn btn-default btn-sm">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Validation Error!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('organization_admin.employees.update', $employee) }}" method="POST" class="form-horizontal">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control input-sm" value="{{ old('name', $employee->name) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control input-sm" value="{{ old('email', $employee->email) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control input-sm" value="{{ old('phone', $employee->phone) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Position</label>
                                <div class="col-sm-9">
                                    <input type="text" name="position" class="form-control input-sm" value="{{ old('position', $employee->position) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control input-sm" required>
                                        <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-save"></i> Update Employee
                                    </button>
                                    <button type="reset" class="btn btn-warning btn-sm">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                    <a href="{{ route('organization_admin.employees.index') }}" class="btn btn-default btn-sm">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
