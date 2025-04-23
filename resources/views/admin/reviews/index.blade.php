@extends('admin.adminLayout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix" style="background-color: #f8f9fa; border-bottom: 1px solid #e7e7e7;">
                    <h3 class="panel-title pull-left" style="padding-top: 7.5px; font-weight: 600; color: #555;">
                        <i class="fa fa-comments" style="color: #6c757d;"></i> Customer Reviews
                    </h3>
                    <div class="btn-group pull-right">
                        <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cog"></i> Options <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-download"></i> Export</a></li>
                            <li><a href="#"><i class="fa fa-filter"></i> Filter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body" style="padding: 20px;">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade in" style="border-left: 4px solid #5cb85c;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if($reviews->count())
                        <div class="row">
                            @foreach($reviews as $review)
                            <div class="col-md-6">
                                <div class="panel panel-default review-card" style="border-radius: 4px; margin-bottom: 20px; border-left: 3px solid #5bc0de;">
                                    <div class="panel-body" style="padding: 15px;">
                                        <div class="media">
                                            <div class="media-left">
                                                @if($review->user && $review->user->image)
                                                <img src="{{ asset('storage/' . $review->user->image) }}"
                                                     class="media-object img-circle"
                                                     style="width: 50px; height: 50px; border: 2px solid #eee;">
                                                @else
                                                <div class="media-object img-circle" style="width: 50px; height: 50px; background: #eee; text-align: center; line-height: 50px;">
                                                    <i class="fa fa-user" style="color: #999;"></i>

                                                </div>
                                                @endif
                                            </div>
                                            <div class="media-body" style="padding-left: 10px;">
                                                <h4 class="media-heading" style="margin-top: 0; margin-bottom: 5px;">
                                                    {{ $review->user->name ?? 'Anonymous' }}
                                                    <small class="text-muted pull-right">{{ $review->created_at->format('M d, Y') }}</small>
                                                </h4>
                                                <p style="margin-bottom: 5px;">
                                                    <strong>Service:</strong> {{ $review->service->name ?? 'N/A' }}
                                                </p>
                                                <div style="margin-bottom: 10px;">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star{{ $i <= $review->rating ? ' text-warning' : ' text-muted' }}"></i>
                                                    @endfor
                                                    <span class="label label-default" style="margin-left: 5px;">{{ $review->rating }}/5</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="review-comment" style="padding: 10px; background: #f9f9f9; border-radius: 3px; margin-top: 10px;">
                                            @if($review->comment)
                                                <p style="margin-bottom: 0;">{{ $review->comment }}</p>
                                            @else
                                                <p class="text-muted" style="margin-bottom: 0;"><i>No comment provided</i></p>
                                            @endif
                                        </div>

                                        <div class="text-right" style="margin-top: 10px;">
                                            <form action="{{ route('admin-reviews.destroy', $review) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger delete-review-btn">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="text-center">
                            {{ $reviews->links() }}
                        </div>
                    @else
                        <div class="well text-center" style="padding: 40px; background: #f9f9f9; border-radius: 4px;">
                            <i class="fa fa-comment-slash fa-4x" style="color: #ddd; margin-bottom: 20px;"></i>
                            <h4 style="color: #777;">No Reviews Found</h4>
                            <p class="text-muted">There are no customer reviews to display at this time.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .review-card:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .review-comment {
        border-left: 3px solid #e1e1e1;
    }
    .pagination > .active > a {
        background-color: #5bc0de;
        border-color: #5bc0de;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-review-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // prevent normal form submit

            const form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to delete this review.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
