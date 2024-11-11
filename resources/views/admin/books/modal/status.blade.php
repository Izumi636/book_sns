{{-- hide --}}
<div class="modal fade" id="hide-book-{{ $book->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-eye-slash"></i> Hide Book
                </h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to hide this book?</p>
                <div class="mt-3">
                    <p class="mt-1 text-muted">{{ $book->title }}</p>
                    <img src="{{ $book->cover_photo }}" alt="book id {{ $book->id }}" class="image-lg">
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.books.hide', $book->id) }}" method="post">
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
<div class="modal fade" id="unhide-book-{{ $book->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title text-primary">
                    <i class="fa-solid fa-eye"></i> Unhide Book
                </h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to unhide this book?</p>
                <div class="mt-3">
                    <p class="mt-1 text-muted">{{ $book->title }}</p>
                    <img src="{{ $book->cover_photo }}" alt="book id {{ $book->id }}" class="image-lg">
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.books.unhide', $book->id) }}" method="post">
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







