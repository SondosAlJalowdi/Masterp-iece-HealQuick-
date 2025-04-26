@extends('organization_admin.orgAdminLayout')

@section('content')
<div class="content-area">
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding: 15px 20px; border-bottom: 1px solid #eee;">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title" style="font-size: 16px; font-weight: 600;">
                                    <i class="fa fa-list-alt" style="margin-right: 8px; color: #178666;"></i>
                                    Services Offered
                                </h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('organization_admin.services.create') }}"
                                   class="btn btn-sm"
                                   style="background-color: #178666; color: #fff; border-radius: 3px; padding: 5px 12px;">
                                    <i class="fa fa-plus" style="margin-right: 5px;"></i> Add New Service
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body" style="padding: 20px;">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" style="border-radius: 3px; margin-bottom: 20px;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fa fa-check" style="margin-right: 5px;"></i> {{ session('success') }}
                            </div>
                        @endif

                        {{-- Search and Filter Form --}}
                        <div class="well" style="background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 3px;">
                            <form method="GET" action="{{ route('organization_admin.services.index') }}" class="form-inline">
                                <div class="form-group" style="margin-right: 10px;">
                                    <select name="service_id" class="form-control input-sm" style="width: 200px; border-radius: 3px;">
                                        <option value="">All Services</option>
                                        @foreach($allServices as $singleService)
                                            <option value="{{ $singleService->id }}" {{ request('service_id') == $singleService->id ? 'selected' : '' }}>
                                                {{ $singleService->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" style="margin-right: 10px;">
                                    <select name="employee_id" class="form-control input-sm" style="width: 200px; border-radius: 3px;">
                                        <option value="">All Employees</option>
                                        @foreach($allEmployees as $singleEmployee)
                                            <option value="{{ $singleEmployee->id }}" {{ request('employee_id') == $singleEmployee->id ? 'selected' : '' }}>
                                                {{ $singleEmployee->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-sm" style="background-color:#178666; color: white; border-radius: 3px;">
                                    <i class="fa fa-filter" style="margin-right: 5px;"></i> Filter
                                </button>

                                <a href="{{ route('organization_admin.services.index') }}"
                                   class="btn btn-default btn-sm"
                                   style="margin-left: 5px; border-radius: 3px;">
                                    <i class="fa fa-refresh" style="margin-right: 5px;"></i> Reset
                                </a>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" style="margin-bottom: 0;">
                                <thead>
                                    <tr style="background-color: #f5f5f5;">
                                        <th style="width: 5%; padding: 12px 8px;">#</th>
                                        <th style="padding: 12px 8px;">Service Name</th>
                                        <th style="padding: 12px 8px;">Employee</th>
                                        <th style="padding: 12px 8px;">Price</th>
                                        <th style="width: 20%; padding: 12px 8px; text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($services as $index => $entry)
                                        <tr>
                                            <td style="padding: 12px 8px; vertical-align: middle;">{{ ($services->currentPage() - 1) * $services->perPage() + $index + 1 }}</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">{{ $entry->service_name }}</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">{{ $entry->employee_name }}</td>
                                            <td style="padding: 12px 8px; vertical-align: middle;">JD {{ number_format($entry->price, 2) }}</td>
                                            <td style="padding: 12px 8px; text-align: center; vertical-align: middle;">
                                                <div class="btn-group btn-group-xs">
                                                    <a href="{{ route('organization_admin.services.show', $entry->id) }}"
                                                       class="btn btn-warning"
                                                       title="View"
                                                       style="padding: 5px 10px; border-radius: 3px 0 0 3px;">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('organization_admin.services.edit', $entry->id) }}"
                                                       class="btn btn-info"
                                                       title="Edit"
                                                       style="padding: 5px 10px; border-radius: 0 3px 3px 0;">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted" style="padding: 20px;">
                                                <i class="fa fa-info-circle" style="margin-right: 5px;"></i> No services found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($services->hasPages())
                            <div class="text-center" style="margin-top: 20px;">
                                {!! $services->appends(request()->query())->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
