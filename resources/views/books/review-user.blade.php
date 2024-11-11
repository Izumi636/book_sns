

<div>
    @if ($book->reviews->isNotEmpty())
        <div class="row justify-content-center">
            <div class="col-4">
                <h3 class="text-muted text-center">Reviewers of this book</h3>
            
                @foreach ($book->reviews as $review)
                    <div class="row align-items-center mt-1 boreder">
                        {{-- avatar --}}
                        <div class="col-auto">
                            <a href="{{route('profiles.show', $review->user->id)}}">
                                @if ($review->user->avatar)
                                    <img src="{{$review->user->avatar}}" alt="{{$review->user->name}}" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        {{-- name --}}
                        <div class="col ps-0 text-truncate">
                            <a href="{{route('profiles.show', $review->user->id)}}" class="text-decoration-none text-dark fw-bold">{{$review->user->name}}</a>
                        </div>
                        <p>{{$review->body}}<span> ★{{$review->stars}}</span>
                        </p>

                        <span class="text-uppercase text-muted xsmall">{{date('M d, Y', strtotime($review->created_at))}}</span>
                        <hr>
                        {{-- button: following / follow--}}
                        {{-- <div class="col ps-0 text-end">
                            @if ($follower->follower->id != Auth::user()->id)
                                @if ($follower->follower->isFollowed())
                                    <form action="{{route('follow.destroy', $follower->follower->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="border-0 bg-transparent p-0 text-secondary btn-sm">
                                            Following
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('follow.store', $follower->follower->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                                    </form>
                                @endif                           
                            @endif
                        </div> --}}
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h3 class="text-muted text-center">No reviewers Yet</h3>
    @endif
</div>


