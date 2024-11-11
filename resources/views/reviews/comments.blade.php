<div class="mt-3">
    {{-- show all comments here --}}
    @if ($review->comments->isNotEmpty())
        <hr>
        <ul class="list-group">
            @foreach ($review->comments->take(3) as $comment)
                <li class="list-group-item border-0 p-0 mb-2">
                    <a href="
                    {{route('profiles.show', $comment->user->id)}}
                    " class="text-decoration-none text-dark fw-bold">{{$comment->user->name}}</a>
                    &nbsp;
                    <p class="d-inline fw-light">{{$comment->body}}</p>
                    <form action="{{route('comment.destroy', $comment->id)}}" method="post">
                        @csrf
                        @method('DELETE')

                        <span class="text-uppercase text-muted xsmall">{{date('M d, Y', strtotime($comment->created_at))}}</span>
                        {{-- if the auth user is theowner of the comment, a delete button. --}}
                        @if (Auth::user()->id === $comment->user->id)
                            &middot;
                            <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                        @endif
                    </form>
                </li>
            @endforeach

            @if ($review->comments->count()>3)
                <li class="list-group-item border-0 px-0 pt-0">
                    <a href="{{route('reviews.show', $review->id)}}" class="text-decoration-none small">View all {{$review->comments->count()}} comments</a>
                </li>
            @endif
        </ul>
    @endif

    <form action="{{route('comment.store', $review->id)}}" method="post">
        @csrf

        <div class="input-group">
            <textarea name="comment_body{{$review->id}}" rows="1" class="form-control form-control-sm" placeholder="Add a comment">{{old('comment_body' . $review->id)}}</textarea>

            <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
        </div>

        {{-- error --}}

        @error('comment_body' . $review->id)

        <div class="text-danger small">{{$message}}</div>
            
        @enderror

    </form>
