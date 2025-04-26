@extends('organization_admin.orgAdminLayout')

@section('content')
<div class="content-area">
    <div class="container-fluid" style="margin-top: 30px">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding: 15px 20px; border-bottom: 1px solid #eee;">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title" style="font-size: 16px; font-weight: 600;">
                                    <i class="fa fa-users" style="margin-right: 8px; color: #178666;"></i> Employee Management
                                </h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('organization_admin.employees.create') }}"
                                   class="btn btn-sm"
                                   style="background-color: #178666; color: #fff; border-radius: 3px; padding: 5px 12px;">
                                    <i class="fa-solid fa-user-plus" style="margin-right: 5px;"></i> Add New Employee
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body" style="padding: 20px;">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" style="border-radius: 3px; padding: 15px;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #fff;">&times;</button>
                                <i class="icon fa fa-check" style="margin-right: 5px;"></i> {{ session('success') }}
                            </div>
                        @endif

                        {{-- Search and Filter Form --}}
                        <div class="well" style="background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 3px;">
                            <form method="GET" action="{{ route('organization_admin.employees.index') }}" class="form-inline">
                                <div class="form-group" style="margin-right: 10px;">
                                    <input type="text" name="search" class="form-control input-sm"
                                           placeholder="Search by name, email..."
                                           style="width: 200px; border-radius: 3px;"
                                           value="{{ request('search') }}">
                                </div>

                                <button type="submit" class="btn btn-sm" style="background-color: #178666; color: white; border-radius: 3px;">
                                    <i class="fa fa-search" style="margin-right: 5px;"></i> Search
                                </button>
                                <a href="{{ route('organization_admin.employees.index') }}"
                                   class="btn btn-default btn-sm"
                                   style="margin-left: 5px; border-radius: 3px;">
                                    <i class="fa fa-refresh" style="margin-right: 5px;"></i> Reset
                                </a>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover" style="margin-bottom: 0;">
                                <thead>
                                    <tr style="background-color: #f5f5f5;">
                                        <th style="width: 5%; padding: 12px 8px;">#</th>
                                        <th style="padding: 12px 8px;">Name</th>
                                        <th style="padding: 12px 8px;">Email</th>
                                        <th style="padding: 12px 8px;">Phone</th>
                                        <th style="padding: 12px 8px;">Position</th>
                                        <th style="width: 10%; padding: 12px 8px; text-align: center;">Status</th>
                                        <th style="width: 15%; padding: 12px 8px; text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employees as $index => $employee)
                                        <tr>
                                            <td style="padding: 12px 8px; vertical-align: middle;">{{ $employees->firstItem() + $index }}</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">{{ $employee->name }}</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">{{ $employee->email }}</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">{{ $employee->phone }}</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">{{ $employee->position }}</td>
                                            <td style="padding: 12px 8px; text-align: center; vertical-align: middle;">
                                                <span class="label label-{{ $employee->status == 'active' ? 'success' : 'default' }}"
                                                      style="display: inline-block; padding: 5px 10px; border-radius: 3px;">
                                                    {{ ucfirst($employee->status) }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px 8px; text-align: center; vertical-align: middle;">
                                                <div class="btn-group btn-group-xs">
                                                    <a href="{{ route('organization_admin.employees.edit', $employee->id) }}"
                                                       class="btn btn-info"
                                                       title="Edit"
                                                       style="padding: 5px 10px; border-radius: 3px 0 0 3px;">
                                                        <i class="fa fa-pencil"></i>Edit
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted" style="padding: 20px;">
                                                <i class="fa fa-info-circle" style="margin-right: 5px;"></i> No employees found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if ($employees->hasPages())
                            <div class="text-center" style="margin-top: 20px;">
                                {!! $employees->appends(request()->query())->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
