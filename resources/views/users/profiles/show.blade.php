@extends('layouts.app')

@section('title', 'Profile Show')

@section('content')

@include('users.profiles.header')
<div style="margin-top: 100px;">
    @if ($user->reviews->isNotEmpty())
        <div class="row">
            @foreach ($user->reviews as $review)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <p>{{$review->book->title}}/                
                            @foreach ($review->book->bookAuthor as $book_author)
                            {{$book_author->author->name}}
                            @endforeach
                        </p>
                        <a href="{{route('reviews.show', $review->id)}}">
                            <img src="{{$review->book->cover_photo}}" alt="review id {{$review->id}}" class="grid-img">
                        </a>
                    </div>
            @endforeach
        </div>
    @else
        <h2 class="text-muted text-center">No reveiws yet</h2>
    @endif
</div>
@endsection