@extends('organization_admin.orgAdminLayout')

@section('content')
    <div class="content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding: 15px 20px; border-bottom: 1px solid #eee;">
                            <h3 class="panel-title" style="font-size: 16px; font-weight: 600;">
                                <i class="fa fa-plus-circle" style="margin-right: 8px; color: #178666;"></i>
                                Add New Service Assignment
                            </h3>
                        </div>

                        <div class="panel-body" style="padding: 25px;">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible"
                                    style="border-radius: 3px; margin-bottom: 20px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                                        style="color: #fff;">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Validation Error!</h4>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('organization_admin.services.store') }}">
                                @csrf

                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label
                                        style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Service</label>
                                    <select name="service_id" class="form-control input-sm" required
                                        style="border-radius: 3px; height: 35px;">
                                        <option value="">-- Select Service --</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label
                                        style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Employee</label>
                                    <select name="employee_id" class="form-control input-sm" required
                                        style="border-radius: 3px; height: 35px;">
                                        <option value="">-- Select Employee --</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" style="margin-bottom: 25px;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Price
                                        ($)</label>
                                    <div class="input-group" style="width: 200px;">
                                        <span class="input-group-addon" style="border-radius: 3px 0 0 3px;">JD</span>
                                        <input type="number" name="price" value="{{ old('price') }}"
                                            class="form-control input-sm" min="0" step="0.01" required
                                            style="border-radius: 0 3px 3px 0;">
                                    </div>
                                </div>

                                <div class="form-group"
                                    style="margin-top: 30px; padding-top: 15px; border-top: 1px solid #eee;">
                                    <button type="submit" class="btn btn-primary btn-sm"
                                        style="background-color: #178666; border-color: #178666; border-radius: 3px; padding: 6px 15px;">
                                        <i class="fa fa-save" style="margin-right: 5px;"></i> Save
                                    </button>
                                    <a href="{{ route('organization_admin.services.index') }}"
                                        class="btn btn-default btn-sm"
                                        style="margin-left: 5px; border-radius: 3px; padding: 6px 15px;">
                                        <i class="fa fa-times" style="margin-right: 5px;"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
