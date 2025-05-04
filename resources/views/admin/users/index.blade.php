@extends('admin.adminLayout')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="card" style="border-radius: 12px; overflow: hidden;">
                <!-- Header -->
                <div class="header clearfix" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 25px; background-color: #f8f9fa; border-bottom: 1px solid #eaeaea;">
                    <h4 class="title" style="font-weight: 600; color: #2c3e50; margin: 0;">
                        <i class="fas fa-users" style="color: #178066; margin-right: 10px;"></i>
                        User Management
                    </h4>
                    <a href="{{ route('users.create') }}" class="btn btn-emerald" style="border-radius: 30px; padding: 8px 20px; border: none;">
                        <i class="fa-solid fa-user-plus" style="margin-right: 8px;"></i>Add New User
                    </a>
                </div>

                <div class="content" style="padding: 25px;">
                    @if(session('success'))
                        <div class="alert alert-emerald alert-dismissible fade show" style="border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #178066;">
                            <i class="fas fa-check-circle" style="margin-right: 10px; color: #178066;"></i>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($users->isEmpty())
                        <div class="text-center py-5" style="background-color: #f8f9fa; border-radius: 10px; border: 1px dashed #d1d9e6;">
                            <i class="fas fa-users-slash" style="font-size: 48px; color: #d1d9e6; margin-bottom: 20px;"></i>
                            <h4 style="color: #2c3e50; font-weight: 500;">No Users Found</h4>
                            <p class="text-muted" style="margin-bottom: 25px;">Get started by adding your first user</p>
                            <a href="{{ route('users.create') }}" class="btn btn-emerald" style="border-radius: 30px; padding: 8px 25px; border: none;">
                                <i class="fa-solid fa-user-plus" style="margin-right: 8px;"></i>Create User
                            </a>
                        </div>
                    @else
                        <div class="row">
                            @foreach($users as $user)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="card card-user" style="border: 1px solid #eaeaea; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px 0 rgba(0,0,0,0.05); margin-bottom: 25px; transition: all 0.3s ease;">
                                    <div class="card-header" style="background-color: #f8f9fa;; color: black; padding: 20px; position: relative;">
                                        <!-- User Avatar/Image -->
                                        <div class="user-avatar" style="width: 70px; height: 70px; background-color: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; overflow: hidden;">
                                            @if ($user->image)
                                        @php
                                            if (str_starts_with($user->image, 'storage/')) {
                                                $imgUrl = Storage::url(
                                                    str_replace('storage/', '', $user->image),
                                                );
                                            }
                                            elseif (file_exists(public_path($user->image))) {
                                                $imgUrl = asset($user->image);
                                            }
                                            elseif (filter_var($user->image, FILTER_VALIDATE_URL)) {
                                                $imgUrl = $user->image;
                                            }
                                            else {
                                                $imgUrl = Storage::url($user->image);
                                            }
                                        @endphp
                                                <img src="{{ asset(  $imgUrl) }}" alt="{{ $imgUrl}}" style="width: 100%; height: 100%; object-fit: cover;">
                                                @elseif($user->organization && $user->organization->logo)
                                                @php
                                            if (str_starts_with($user->organization->logo, 'storage/')) {
                                                $logoUrl = Storage::url(
                                                    str_replace('storage/', '', $user->organization->logo),
                                                );
                                            }
                                            elseif (file_exists(public_path($user->organization->logo))) {
                                                $logoUrl = asset($user->organization->logo);
                                            }
                                            elseif (filter_var($user->organization->logo, FILTER_VALIDATE_URL)) {
                                                $logoUrl = $user->organization->logo;
                                            }
                                            else {
                                                $logoUrl = Storage::url($user->organization->logo);
                                            }
                                        @endphp
                                                <img src="{{ asset( $logoUrl) }}" alt="{{ $logoUrl }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <span style=" font-size: 28px; font-weight: bold;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            <h5 class="card-title" style="font-weight: 600; margin-bottom: 5px;">{{ $user->name }}</h5>
                                            <p class="card-category" style="font-size: 13px; margin-bottom: 0;">{{ $user->email }}</p>
                                        </div>
                                        <div class="role-badge" style="position: absolute; top: 15px; right: 15px;">
                                            <span class="badge badge-{{ $user->role === 'admin' ? 'emerald-light' : ($user->role === 'organization_admin' ? 'emerald-dark' : 'emerald') }}" style="border-radius: 12px; padding: 5px 12px; font-size: 12px; font-weight: 500;">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body" style="padding: 20px;">
                                        <div class="user-details">
                                            <div class="detail-item" style="display: flex; align-items: center; margin-bottom: 15px;">
                                                <div class="icon-circle" style="width: 36px; height: 36px; background-color: #e8f5f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: #178066;">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                                <div>
                                                    <p style="margin-bottom: 2px; font-size: 12px; color: #7f8c8d;">Phone</p>
                                                    <p style="margin-bottom: 0; font-weight: 500; color: #2c3e50;">{{ $user->phone_number ?: 'Not provided' }}</p>
                                                </div>
                                            </div>

                                            <div class="detail-item" style="display: flex; align-items: center; margin-bottom: 15px;">
                                                <div class="icon-circle" style="width: 36px; height: 36px; background-color: #e8f5f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: #178066;">
                                                    <i class="fas fa-building"></i>
                                                </div>
                                                <div>
                                                    <p style="margin-bottom: 2px; font-size: 12px; color: #7f8c8d;">Organization</p>
                                                        <p style="margin-bottom: 0; font-weight: 500; color: #2c3e50;">{{ $user->organization->name ?? 'Not assigned' }}</p>

                                                </div>
                                            </div>

                                            <div class="detail-item" style="display: flex; align-items: center;">
                                                <div class="icon-circle" style="width: 36px; height: 36px; background-color: #e8f5f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: #178066;">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                                <div>
                                                    <p style="margin-bottom: 2px; font-size: 12px; color: #7f8c8d;">Address</p>
                                                    <p style="margin-bottom: 0; font-weight: 500; color: #2c3e50;">{{ $user->address ?: 'Not provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="background-color: #f8f9fa; border-top: 1px solid #eaeaea; padding: 15px 20px;">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-emerald" style="border-radius: 20px; padding: 5px 15px; font-size: 12px;">
                                                <i class="fas fa-eye" style="margin-right: 5px;"></i> View
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-emerald" style="border-radius: 20px; padding: 5px 15px; font-size: 12px;">
                                                <i class="fas fa-edit" style="margin-right: 5px;"></i> Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 20px; padding: 5px 15px; font-size: 12px; border-color: #e74c3c; color: #e74c3c;">
                                                    <i class="fas fa-trash-alt" style="margin-right: 5px;"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation" class="d-flex justify-content-center">
                                    <ul class="pagination">
                                        {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
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
    }

    .badge-emerald {
        background-color: #178066;
        color: white;
    }

    .badge-emerald-light {
        background-color: #1aa384;
        color: white;
    }

    .badge-emerald-dark {
        background-color: #126652;
        color: white;
    }

    .btn-outline-emerald {
        color: #178066;
        border-color: #178066;
        transition: all 0.3s ease;
    }

    .btn-outline-emerald:hover {
        background-color: #178066;
        color: white;
    }

    /* Card Hover Effect */
    .card-user:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px 0 rgba(0,0,0,0.1);
    }

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
</style>
@endsection
