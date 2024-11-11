{{-- hide --}}
<div class="modal fade" id="hide-review-{{ $review->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-eye-slash"></i> Hide Review
                </h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to hide this review?</p>
                <div class="mt-3">
                    <p class="mt-1 text-muted">{{ $review->book->title }}</p>
                    <p class="mt-1 text-muted">{{ $review->body }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.reviews.hide', $review->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- unhide --}}
<div class="modal fade" id="unhide-review-{{ $review->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title text-primary">
                    <i class="fa-solid fa-eye"></i> Unhide Review
                </h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to unhide this review?</p>
                <div class="mt-3">
                    <p class="mt-1 text-muted">{{ $review->book->title }}</p>
                    <p class="mt-1 text-muted">{{ $review->body }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.reviews.unhide', $review->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div>







