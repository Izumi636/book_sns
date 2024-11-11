@extends('layouts.app')

@section('title','Favorites')
@section('content')
@include('users.profiles.header')

    <div style="margin-top: 100px;">

        @if ($user->favorites->isNotEmpty())
        <h3 class="text-muted text-center">Your Favorite books</h3>
        <div class="container">
        <div class="row">
            @foreach ($user->favorites as $favorite)
                    <div class="col-lg-4 mb-4 border">    
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <a href="{{route('books.show', $favorite->book->id)}}">
                                    <img src="{{$favorite->book->cover_photo}}" alt="book id {{$favorite->book->id}}" class="grid-img">
                                </a>                            
                            </div>
                            <div class="col-auto">
                                
                                <a href="{{route('books.show', $favorite->book->id)}}" class="text-decoration-none text-dark h3">
                            
                                    {{$favorite->book->title}}
                                </a>
                            </div>
                            <div class="col-auto text-truncate">
                                <h3>
                                @foreach ($favorite->book->bookAuthor as $book_author)
                                {{$book_author->author->name}} 
                                </h3>
                                @endforeach
                            </div>
                            <div class="col-6">
                                @foreach ($favorite->book->bookCategory as $book_category)
                                <span class="badge bg-secondary bg-opacity-50">{{$book_category->category->name}}</span>
                                    
                                @endforeach
                            </div>
                            <div class="col-6 text-end">
                                {{-- add button -> add review --}}
                                <a href="{{route('reviews.add', $favorite->book->id)}}" class="btn btn-success">
                                    Add Review
                                </a>
                            </div>
                        </div>
                    </div>
                
            @endforeach
        </div>
            </div>
        @else
            <h3 class="text-muted text-center">No books Yet</h3>
        @endif
</div>
@endsection