<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{$user->name}}</h2>
            </div>

            <div class="col-auto p-2">
                @if (Auth::user()->id === $user ->id)
                    <a href="{{route('profile.edit')}}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    @if ($user->isFollowed())
                    <form action="{{route('follow.destroy', $user->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                    </form>

                    @else
                    <form action="{{route('follow.store', $user->id)}}" method="post" class="d-inline">
                        @csrf

                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                    </form>
                    @endif
                @endif

            </div>
        </div>
        <div class="row mb-3">
            {{-- condition ? true statement: false statement --}}
           <div class="col-auto">
               <a href="{{route('profiles.show', $user->id)}}" class="text-decoration-none text-dark">
                   <strong>{{$user->reviews->count()}}</strong> {{$user->reviews->count() == 1 ? 'review' : 'reviews'}}
               </a>
           </div>
           <div class="col-auto">
              
               <a href="
               {{route('profile.followers', $user->id)}}
               " class="text-decoration-none text-dark">
                   <strong>{{$user->followers->count()}}</strong> {{$user->followers->count() == 1 ? 'follower' : 'followers'}}
               </a>
           </div>
           <div class="col-auto">
               <a href="
               {{route('profile.following', $user->id)}}
               " class="text-decoration-none text-dark">
                   <strong>{{$user->following->count()}}</strong> following
                </a>
           </div>
           <div class="col-auto">
            <a href="{{route('profile.favorite', $user->id)}}" class="text-decoration-none text-dark">You have <strong>{{$user->favorites->count()}}</strong> favorite {{$user->favorites->count() == 1 ? 'book' : 'books'}}
            </a>
           </div>
           <div class="col-auto">
            <a href="{{route('profile.added', $user->id)}}" class="text-decoration-none text-dark">You added <strong>{{$user->books->count()}}</strong> {{$user->books->count() == 1 ? 'book' : 'books'}}</a>
           </div>
       </div>

       <span class="fw-bold">{{$user->introduction}}</span>
       <a href="{{route('messages.add', $user->id)}}" class="btn btn-outline-secondary ms-3"><i class="fa fa-envelope"></i> Send messages</a>
   </div>

</div>