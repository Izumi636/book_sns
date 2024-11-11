@if ($group->groupComments->isNotEmpty())
<hr>
<ul class="list-group">
    @foreach ($group->groupComments as $comment)
        <li class="list-group-item border-0 p-0 mb-2">
            <a href="
            {{route('profiles.show', $comment->user->id)}}
            " class="text-decoration-none text-dark fw-bold">{{$comment->user->name}}</a>
            &nbsp;
            <br>
            <p class="d-inline fw-light">{{$comment->body}}</p>
            <form action="
            {{route('groups.comment.destroy', $comment->id)}}
            " method="post">
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
</ul>
@else
<h3>No comments yet</h3>
@endif

<form action="{{route('groups.comment.store', $group->id)}}" method="post">
@csrf

<div class="input-group">
    <textarea name="comment_body" rows="1" class="form-control form-control-sm" placeholder="Add a comment"></textarea>
    <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
</div>

{{-- error --}}

@error('comment_body')

<div class="text-danger small">{{$message}}</div> 
    
@enderror 

</form>
