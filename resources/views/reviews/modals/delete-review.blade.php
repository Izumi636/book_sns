<div class="modal fade" id="delete-review-{{$review->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 model-title text-danger">
                    <i class="fas fa-circle exlamation"></i> Delete Review
                </h3>
            </div>
        

        <div class="modal-body text-center">
            <i class="fa-solid fa-triangle-exclamation text-warning fa-5x"></i>
            <p>Are you sure you want to delete this review</p>
        </div>
        <div class="modal-footer border-0">
            <form action="{{route('reviews.destroy', $review->id)}}" method="post">
                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
        </div>
    </div>
</div>