@extends('admin.adminLayout')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="background-color: #62d2a2; color: white; border-radius: 10px 10px 0 0; padding: 15px;">
                        <h4 class="title" style="margin: 0; display: inline-block;">Contact Messages</h4>
                        <div class="clearfix"></div>
                    </div>

                    <div class="content" style="padding: 20px;">
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('contacts.index') }}" class="form-inline" style="margin-bottom: 20px;">
                            <div class="form-group" style="margin-right: 10px;">
                                <input type="text" name="search" class="form-control" placeholder="Search by name or subject" value="{{ request('search') }}" style="border-radius: 5px;">
                            </div>
                            <button type="submit" class="btn btn-fill" style="background-color:#62d2a2; border-radius: 5px;">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </form>

                        <!-- Contacts List -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-fill" style="background-color:#62d2a2; border-radius: 5px;">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="text-center">
                            {{ $contacts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
