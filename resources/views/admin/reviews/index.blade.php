@extends('layouts.app')

@section('title', 'Admin: Reviews')
@section('content')
    

<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="table-primary text-secondary small">
        <tr>
            <th></th>
            <th>BOOK</th>
            <th>STARS</th>
            <th>OWNER</th>
            <th>CREATED AT</th>
            <th>LIKES</th>
            <th>COMMENTS</th>
            <th>STATUS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
         @forelse ($all_reviews as $review)
            <tr>
                <td class="text-end">
                    <a href="{{route('reviews.show', $review->id)}}">{{$review->id}}</a>
                </td>
                <td>
                    {{$review->book->title}}
                </td>
                <td>
                    {{$review->stars}}                
                </td>
                <td>
                    <a href="{{route('profiles.show', $review->user->id)}}" class="text-dark text-decoration-none"></a>
                    {{$review->user->name}}</td>
                <td>{{$review->created_at}}</td>
                <td>{{$review->likes->count()}}</td>
                <td>{{$review->comments->count()}}</td>
                <td> 
                    {{-- $user->trashed() returns True if the user was soft deleted. --}}
                      @if ($review->trashed()) 
                        <i class="fa-regular fa-circle text-secondary"></i>&nbsp;Hidden</td>
                    @else 
                        <i class="fa-solid fa-circle text-primary"></i>&nbsp;Visible</td>
                     @endif
                <td>
                    @if (Auth::user()->id !== $review->user->id)
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($review->trashed()) 
                                    <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#unhide-review-{{$review->id}}">
                                        <i class="fa-solid fa-user-check"></i> Unhide review {{$review->id}}
                                    </button>
                       
                                @else
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-review-{{$review->id}}">
                                        <i class="fa-solid fa-eye-slash"></i> Hide review {{$review->id}}
                                    </button>
                                 @endif 
                            </div>
                        </div>
 
                        {{-- include modal here --}}
                        @include('admin.reviews.modal.status')
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="lead text-muted text-center">No Reviews Yet</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{$all_reviews->links() }}
</div>
@endsection