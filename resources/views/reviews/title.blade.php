<div class="card-header bg-white py-3">
    <div class="row align-items center">
        <div class="col-auto">
            <a href="{{route('profiles.show', $review->user->id)}}">
                @if ($review->user->avatar)
                    <img src="{{$review->user->avatar}}" alt="{{$review->user->name}}" class="rounded-circle avatar-sm">
                @else
                    <i class="fas fa-circle-user text-secondary icon-sm"></i>
                @endif
            </a>
        </div>
        <div class="col-auto">
            <a href="{{route('profiles.show', $review->user->id)}}" class="text-decoration-none text-dark">{{$review->user->name}}</a>

        </div>

        <div class="col text-start">
            @if (Auth::user()->id === $review->user ->id)
                <span>Your review</span>
            @else
                    @if ($review->user->isfollowed() )
                    <form action="{{route('follow.destroy', $review->user->id)}}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="border-0 bg-transparent p-0 text-secondary btn-sm">
                            following
                        </button>
                    </form>
                @else
                    <form action="{{route('follow.store', $review->user->id)}}" method="post">
                        @csrf

                        <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">
                            follow
                        </button>
                    </form>   
                @endif

            @endif

        </div>
        
        <div class="col-auto text-end">
            <p class="text-upper-case text-muted xsmall">{{date('M d, Y', strtotime($review->created_at))}}</p>
        </div>
        <div class="col-auto">
            {{-- dropdown button --}}
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis"></i>
                    </button>
    
                    {{-- if you are the owner of the post, you can edit or delete this post --}}
                
                    @if (Auth::user()->id === $review->user->id)
                    <div class="dropdown-menu">
                        <a href="{{route('reviews.edit', $review->id)}}" class="dropdown-item">
                            <i class="far fa-pen-to-square"></i>Edit
                        </a>
    
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-review-{{$review->id}}">
                            <i class="far fa-trash-can"></i>Delete
                        </button>
                    </div>
                        {{-- include model here --}}
                        @include('reviews.modals.delete-review')
                    @else
                        {{-- if following this user->unfollow,
                        if not following this user->follow --}}
                        {{-- <div class="dropdown-menu">
                            <form action="{{route('follow.destroy', $review->user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
    
                                <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                            </form>
                        </div> --}}
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>