@extends('admin.adminLayout')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="header" style="background-color: #62d2a2; color: white; border-radius: 10px 10px 0 0; padding: 15px;">
                        <h4 class="title" style="padding: 5px; display: inline-block;">My Profile</h4>
                        <div style="float: right;">
                            <button id="toggleEditBtn" class="btn btn-default" style="padding: 8px 20px;">
                                <i class="fa fa-edit"></i> Edit Profile
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible" style="margin: 15px; border-radius: 5px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" style="margin: 15px; border-radius: 5px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="content" style="padding: 20px;">
                        {{-- View Mode --}}
                        <div id="profileView">
                            <div class="row">
                                <div class="col-sm-3 text-center">
                                    @if(auth()->user()->image)
                                        <img src="{{ Storage::url(auth()->user()->image) }}" alt="Profile Image" class="img-rounded img-responsive" style="margin: 0 auto; max-width: 150px; border-radius: 50%;">
                                    @else
                                        <img src="{{ asset('images/default_user.jpg') }}" alt="Default Icon" class="img-rounded img-responsive" style="margin: 0 auto; max-width: 150px; border-radius: 50%;">
                                    @endif
                                </div>
                                <div class="col-sm-9">
                                    <table class="table table-user-information" style="font-size: 16px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%;"><strong>Name:</strong></td>
                                                <td>{{ auth()->user()->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email:</strong></td>
                                                <td>{{ auth()->user()->email }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Phone Number:</strong></td>
                                                <td>{{ auth()->user()->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Address:</strong></td>
                                                <td>{{ auth()->user()->address }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Edit Mode --}}
                        <div id="profileEditForm" style="display: none;">
                            <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-sm-3 text-center">
                                        @if(auth()->user()->image)
                                            <input type="hidden" name="old_image" value="{{ auth()->user()->image }}">
                                            <img id="profileImagePreview" src="{{ Storage::url(auth()->user()->image) }}" alt="Profile Image" class="img-rounded img-responsive" style="margin: 0 auto; max-width: 150px; border-radius: 50%;">
                                        @else
                                            <img id="profileImagePreview" src="{{ asset('images/default_user.jpg') }}" alt="Default Icon" class="img-rounded img-responsive" style="margin: 0 auto; max-width: 150px; border-radius: 50%;">
                                        @endif
                                        <div class="form-group" style="margin-top: 15px;">
                                            <label for="image">Change Picture</label>
                                            <input type="file" name="image" id="image" accept="image/*" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" required style="border-radius: 5px;">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly style="border-radius: 5px;">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" required style="border-radius: 5px;">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ old('address', auth()->user()->address) }}" required style="border-radius: 5px;">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-fill pull-right" style=" padding: 12px 30px; background: linear-gradient(135deg, #5bc0de, #00c6ff); color: white; font-size: 16px; font-weight: 600; transition: all 0.3s ease-in-out; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: none;">
                                                <i class="fa fa-save"></i> Update Profile
                                            </button>


                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize with view mode visible and edit mode hidden
        $('#profileView').show();
        $('#profileEditForm').hide();

        // Toggle between view and edit modes
        $('#toggleEditBtn').on('click', function() {
            $('#profileView').toggle();
            $('#profileEditForm').toggle();

            // Update button text and icon
            if ($('#profileEditForm').is(':visible')) {
                $(this).html('<i class="fa fa-times"></i> Cancel');
                $(this).removeClass('btn-light').addClass('btn-default');
            } else {
                $(this).html('<i class="fa fa-edit"></i> Edit Profile');
                $(this).removeClass('btn-default').addClass('btn-light');
            }
        });

        // Cancel button functionality
        $('#cancelEditBtn').on('click', function() {
            $('#profileView').show();
            $('#profileEditForm').hide();
            $('#toggleEditBtn').html('<i class="fa fa-edit"></i> Edit Profile').removeClass('btn-default').addClass('btn-light');
        });

        // Image preview functionality
        $('#image').on('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImagePreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>

@endsection
