@extends('organization_admin.orgAdminLayout')

@section('content')
    <div class="content-area">
        <div class="container-fluid" style="margin-top: 30px">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding: 15px 20px; border-bottom: 1px solid #eee;">
                            <h3 class="panel-title" style="font-size: 16px; font-weight: 600;">
                                <i class="fa fa-info-circle" style="margin-right: 8px; color: #178666;"></i>
                                Service and Employee Details
                            </h3>
                        </div>

                        <div class="panel-body" style="padding: 25px;">
                            <!-- Service Information Section -->
                            <div class="section-box" style="margin-bottom: 30px;">
                                <h4 class="section-title"
                                    style="font-size: 15px; color: #178666; margin-bottom: 20px; padding-bottom: 8px; border-bottom: 1px solid #eee;">
                                    <i class="fa-solid fa-clipboard-list" style="margin-right: 8px;"></i> Service Information
                                </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item" style="margin-bottom: 15px;">
                                            <strong style="display: block; color: #555; margin-bottom: 3px;">Service
                                                Name:</strong>
                                            <p style="font-size: 14px; color: #333;">{{ $service->service_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item" style="margin-bottom: 15px;">
                                            <strong style="display: block; color: #555; margin-bottom: 3px;">Price:</strong>
                                            <p style="font-size: 14px; color: #333;">
                                                ${{ number_format($service->price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Employee Information Section -->
                            <div class="section-box" style="margin-bottom: 30px;">
                                <h4 class="section-title"
                                    style="font-size: 15px; color: #178666; margin-bottom: 20px; padding-bottom: 8px; border-bottom: 1px solid #eee;">
                                    <i class="fa fa-user" style="margin-right: 8px;"></i> Employee Information
                                </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item" style="margin-bottom: 15px;">
                                            <strong style="display: block; color: #555; margin-bottom: 3px;">Employee
                                                Name:</strong>
                                            <p style="font-size: 14px; color: #333;">{{ $employee->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item" style="margin-bottom: 15px;">
                                            <strong style="display: block; color: #555; margin-bottom: 3px;">Email:</strong>
                                            <p style="font-size: 14px; color: #333;">{{ $employee->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item" style="margin-bottom: 15px;">
                                            <strong style="display: block; color: #555; margin-bottom: 3px;">Phone:</strong>
                                            <p style="font-size: 14px; color: #333;">{{ $employee->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item" style="margin-bottom: 15px;">
                                            <strong
                                                style="display: block; color: #555; margin-bottom: 3px;">Position:</strong>
                                            <p style="font-size: 14px; color: #333;">{{ $employee->position }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item" style="margin-bottom: 15px;">
                                            <strong
                                                style="display: block; color: #555; margin-bottom: 3px;">Status:</strong>
                                            <p style="font-size: 14px; color: #333;">
                                                <span
                                                    class="label label-{{ $employee->status == 'active' ? 'success' : 'default' }}"
                                                    style="display: inline-block; padding: 3px 8px; border-radius: 3px;">
                                                    {{ ucfirst($employee->status) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons"
                                style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                                <a href="{{ route('organization_admin.services.index') }}" class="btn btn-default"
                                    style="margin-right: 10px; border-radius: 3px;">
                                    <i class="fa fa-arrow-left" style="margin-right: 5px;"></i> Back to List
                                </a>
                                <a href="{{ route('organization_admin.services.edit', $service->id) }}"
                                    class="btn btn-primary"
                                    style="background-color: #178666; border-color: #178666; border-radius: 3px;">
                                    <i class="fa fa-pencil" style="margin-right: 5px;"></i> Edit Service
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
