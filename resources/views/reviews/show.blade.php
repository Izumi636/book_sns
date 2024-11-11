@extends('layouts.app')

@section('title', "Show Review")
    
@section('content')
<div class="card mb-4">
    @include('reviews.title')
    <div class="card-body">
        <div class="p-0">
            <a href="{{route('books.show', $review->book->id)}}">
                <img src="{{$review->book->cover_photo}}" alt="review id {{$review->book->id}}" class="w-100 photo-md">
            </a>
        </div>
        <div class="row align-items-center mt-2">
            <div class="col-auto">
                {{-- book name --}}
                <a href="{{route('books.show', $review->book->id)}}" class="text-decoration-none text-dark fw-bold">
                    {{$review->book->title}} / 
                    @foreach ($review->book->bookAuthor as $book_author)
                        {{$book_author->author->name}}
                    @endforeach
    
                </a>
            </div>
            <div class="col-auto">
                {{-- category --}}
                 <div class="col text-end">
                    @forelse ($review->book->bookCategory as $book_category)
                        {{-- dd($book_category) --}}
                        <span class="badge bg-secondary bg-opacity-50">{{$book_category->category->name}}</span>
                    @empty
                        <div class="badge bg-dark text-wrap">Uncategorized</bg-dark>
                    @endforelse
                </div>
            </div> 
            <div class="col-auto">
                {{-- heart --}}
                @if ($review->isLiked())
                    <form action="{{route('like.destroy', $review->id)}}" method="post">
                        @csrf
                        @method('DELETE')
    
                        <button type="submit" class="btn btn-sm p-0">
                            <i class="fa-solid fa-heart text-danger fa-2x"></i>
                        </button>
                    </form>
                @else
                    <form action="{{route('like.store', $review->id)}}" method="post">
                        @csrf
    
                        <button type="submit" class="btn btn-sm shadow-none p-0">
                            <i class="far fa-heart fa-2x"></i>
                        </button>
                    </form>   
                @endif
                {{-- heart count --}}
            </div>
            <div class="col-auto px-0">
                <span>{{$review->likes->count()}}</span>
            </div>
            
            
        
        </div>
        <div class="row">
           
        </div>
        <div class="row mt-2">
            <div class="col-auto">
                <p class="d-inline fw-light">{{$review->body}}</p>
            </div>
            <div class="col-auto">
                <p class="d-inline text-end">★{{$review->stars}}</p>
    
            </div>
        </div>
    
        <div class="mt-4">
            <form action="{{route('comment.store', $review->id)}}" method="post">
                @csrf
                <div class="input-group">
                    <textarea name="comment_body{{$review->id}}" rows="1" class="form-control form-control-sm" placeholder="Add a comment">{{old('comment_body' . $review->id)}}</textarea>
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                </div>
        
                {{-- error --}}
                @error('comment_body'. $review->id)
                    <div class="text-danger small">{{$message}}</div>
                @enderror
            </form>

            {{-- display  show all comments here--}}
            @if ($review->comments->isNotEmpty())
            <ul class="list-group mt-2">
                @foreach ($review->comments as $comment)
                    <li class="list-group-item border-0 p-0 mb-2">
                        <a href="{{route('profiles.show', $comment->user->id)}}" class="text-decoration-none text-dark fw-bold">{{$comment->user->name}}</a>
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
            </ul>
            @endif
        </div>
    </div>
    
</div>

@endsection