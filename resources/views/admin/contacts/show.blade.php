@extends('admin.adminLayout')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="background-color: #62d2a2; color: white; border-radius: 10px 10px 0 0; padding: 15px;">
                        <h4 class="title" style="margin: 0; display: inline-block;">Contact Details</h4>
                        <div class="clearfix"></div>
                    </div>

                    <div class="content" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default" style="border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                    <div class="panel-heading" style="background-color: #f5f5f5; padding: 15px; border-radius: 5px 5px 0 0;">
                                        <h3 class="panel-title"><strong>{{ $contact->name }}</strong> - {{ $contact->subject }}</h3>
                                    </div>
                                    <div class="panel-body" style="padding: 20px;">

                                        <div class="form-group">
                                            <label>Message:</label>
                                            <div class="well" style="background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
                                                {{ $contact->message }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer" style="background-color: #f5f5f5; padding: 15px; border-radius: 0 0 5px 5px;">
                                        <small class="text-muted">Received on: {{ $contact->created_at->format('d M Y, h:i A') }}</small>
                                    </div>
                                </div>

                                <div class="text-center" style="margin-top: 20px;">
                                    <a href="{{ route('contacts.index') }}" class="btn btn-default btn-fill" style="border-radius: 5px;">
                                        <i class="fa fa-arrow-left"></i> Back to Contacts
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
