@extends('admin.adminLayout')

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="card" style="border-radius: 12px; overflow: hidden;">
                    <!-- Header -->
                    <div class="header clearfix"
                        style="display: flex; justify-content: space-between; align-items: center; padding: 20px 25px; background-color: #f8f9fa; border-bottom: 1px solid #eaeaea;">
                        <h4 class="title" style="font-weight: 600; color: #2c3e50; margin: 0;">
                            <i class="fa fa-building" style="color: #178066; margin-right: 10px;"></i>
                            Organizations Management
                        </h4>
                        <a href="{{ route('organizations.create') }}" class="btn btn-emerald"
                            style="border-radius: 30px; padding: 8px 20px; border: none;">
                            <i class="fa fa-plus" style="margin-right: 8px;"></i>Add New Organization
                        </a>
                    </div>

                    <div class="well"
                        style="background-color: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 3px;">
                        <form method="GET" action="{{ route('organizations.index') }}" class="form-inline">
                            <div class="form-group" style="margin-right: 10px;">
                                <input type="text" name="search" class="form-control input-sm"
                                    placeholder="Search by name, email..." style="width: 200px; border-radius: 3px;"
                                    value="{{ request('search') }}">
                            </div>

                            <button type="submit" class="btn btn-sm"
                                style="background-color: #178666; color: white; border-radius: 3px;">
                                <i class="fa fa-search" style="margin-right: 5px;"></i> Search
                            </button>
                            <a href="{{ route('organizations.index') }}" class="btn btn-default btn-sm"
                                style="margin-left: 5px; border-radius: 3px;">
                                <i class="fa fa-refresh" style="margin-right: 5px;"></i> Reset
                            </a>
                        </form>
                    </div>
                    <div class="content" style="padding: 25px;">
                        @if (session('success'))
                            <div class="alert alert-emerald alert-dismissible"
                                style="border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #178066;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-check-circle" style="margin-right: 10px; color: #178066;"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($organizations->isEmpty())
                            <div class="text-center py-5"
                                style="background-color: #f8f9fa; border-radius: 10px; border: 1px dashed #d1d9e6;">
                                <i class="fa fa-building" style="font-size: 48px; color: #d1d9e6; margin-bottom: 20px;"></i>
                                <h4 style="color: #2c3e50; font-weight: 500;">No Organizations Found</h4>
                                <p class="text-muted" style="margin-bottom: 25px;">Get started by adding your first
                                    organization</p>
                                <a href="{{ route('organizations.create') }}" class="btn btn-emerald"
                                    style="border-radius: 30px; padding: 8px 25px; border: none;">
                                    <i class="fa fa-plus" style="margin-right: 8px;"></i>Create Organization
                                </a>
                            </div>
                        @else
                            <div class="row">
                                @foreach ($organizations as $org)
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card card-org"
                                            style="border: 1px solid #eaeaea; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px 0 rgba(0,0,0,0.05); margin-bottom: 25px; transition: all 0.3s ease;">
                                            <div class="card-header"
                                                style="background-color: #f8f9fa; padding: 20px; position: relative;">
                                                <!-- Organization Logo -->
                                                <div class="org-logo"
                                                    style="width: 70px; height: 70px; background-color: #e8f5f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; overflow: hidden;">
                                                    @if ($org->logo)
                                                        @php
                                                            if (str_starts_with($org->logo, 'storage/')) {
                                                                $logoUrl = Storage::url(
                                                                    str_replace('storage/', '', $org->logo),
                                                                );
                                                            } elseif (file_exists(public_path($org->logo))) {
                                                                $logoUrl = asset($org->logo);
                                                            } elseif (filter_var($org->logo, FILTER_VALIDATE_URL)) {
                                                                $logoUrl = $org->logo;
                                                            } else {
                                                                $logoUrl = Storage::url($org->logo);
                                                            }
                                                        @endphp
                                                        <img src="{{ $logoUrl }}" alt="{{ $org->name }}"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                    @else
                                                        <span style="font-size: 28px; font-weight: bold; color: #178066;">
                                                            {{ strtoupper(substr($org->name, 0, 1)) }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <h5 class="card-title" style="font-weight: 600; margin-bottom: 5px;">
                                                        {{ $org->name }}</h5>
                                                    <p class="card-category" style="font-size: 13px; margin-bottom: 0;">
                                                        {{ $org->email }}</p>
                                                </div>
                                            </div>
                                            <div class="card-body" style="padding: 20px;">
                                                <div class="org-details">
                                                    <div class="detail-item"
                                                        style="display: flex; align-items: center; margin-bottom: 15px;">
                                                        <div class="icon-circle"
                                                            style="width: 36px; height: 36px; background-color: #e8f5f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: #178066;">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                        <div>
                                                            <p style="margin-bottom: 2px; font-size: 12px; color: #7f8c8d;">
                                                                Phone</p>
                                                            <p style="margin-bottom: 0; font-weight: 500; color: #2c3e50;">
                                                                {{ $org->phone ?: 'Not provided' }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="detail-item"
                                                        style="display: flex; align-items: center; margin-bottom: 15px;">
                                                        <div class="icon-circle"
                                                            style="width: 36px; height: 36px; background-color: #e8f5f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: #178066;">
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                        <div>
                                                            <p style="margin-bottom: 2px; font-size: 12px; color: #7f8c8d;">
                                                                Address</p>
                                                            <p style="margin-bottom: 0; font-weight: 500; color: #2c3e50;">
                                                                {{ $org->address ?: 'Not provided' }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="detail-item" style="display: flex; align-items: center;">
                                                        <div class="icon-circle"
                                                            style="width: 36px; height: 36px; background-color: #e8f5f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: #178066;">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <div>
                                                            <p
                                                                style="margin-bottom: 2px; font-size: 12px; color: #7f8c8d;">
                                                                Created By</p>
                                                            <p style="margin-bottom: 0; font-weight: 500; color: #2c3e50;">
                                                                {{ $org->user->name ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer"
                                                style="background-color: #f8f9fa; border-top: 1px solid #eaeaea; padding: 15px 20px;">
                                                <div class="row">
                                                    <div class="col-xs-4 text-center">
                                                        <a href="{{ route('organizations.show', $org) }}"
                                                            class="btn btn-xs btn-outline-emerald"
                                                            style="border-radius: 20px; padding: 5px 10px; font-size: 12px;">
                                                            <i class="fa fa-eye" style="margin-right: 5px;"></i> View
                                                        </a>
                                                    </div>
                                                    <div class="col-xs-4 text-center">
                                                        <a href="{{ route('organizations.edit', $org) }}"
                                                            class="btn btn-xs btn-outline-emerald"
                                                            style="border-radius: 20px; padding: 5px 10px; font-size: 12px;">
                                                            <i class="fa fa-edit" style="margin-right: 5px;"></i> Edit
                                                        </a>
                                                    </div>
                                                    <div class="col-xs-4 text-center">
                                                        <form action="{{ route('organizations.destroy', $org) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this organization?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-xs btn-outline-danger"
                                                                style="border-radius: 20px; padding: 5px 10px; font-size: 12px; border-color: #e74c3c; color: #e74c3c;">
                                                                <i class="fa fa-trash" style="margin-right: 5px;"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <!-- Pagination -->
                            <div class="row">
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation" class="d-flex justify-content-center">
                                        <ul class="pagination">
                                            {{ $organizations->onEachSide(1)->links('pagination::bootstrap-4') }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Emerald Theme Styles */
        .btn-emerald {
            color: #178066;
            box-shadow: 0 4px 15px rgba(23, 128, 102, 0.3);
            transition: all 0.3s ease;
        }

        .btn-emerald:hover {
            color: white;
            box-shadow: 0 4px 20px rgba(23, 128, 102, 0.5);
            transform: translateY(-1px);
        }

        .alert-emerald {
            background-color: #f0f9f6;
            color: #178066;
            border-color: #d1e7dd;
        }

        .btn-outline-emerald {
            color: #178066;
            border-color: #178066;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-emerald:hover {
            background-color: #178066;
            color: white;
        }

        /* Card Hover Effect */
        .card-org:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px 0 rgba(0, 0, 0, 0.1);
        }

        /* Pagination Styles */

        /* Pagination Styles */
        .page-item.active .page-link {
            background: linear-gradient(135deg, #178066 0%, #1aa384 100%);
            border-color: transparent;
            color: white;
        }

        .page-link {
            color: #178066;
            margin: 0 5px;
            border-radius: 8px !important;
            border: 1px solid #eaeaea;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            color: #126652;
            border-color: #d1d9e6;
        }

        .org-logo {
            transition: transform 0.3s ease;
        }

        .card-org:hover .org-logo {
            transform: scale(1.05);
        }
    </style>
@endsection
