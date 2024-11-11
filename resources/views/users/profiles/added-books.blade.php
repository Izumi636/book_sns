@extends('layouts.app')

@section('title','Favorites')
@section('content')
@include('users.profiles.header')

    <div style="margin-top: 100px;">

        @if ($user->books->isNotEmpty())
        <h3 class="text-muted text-center">The books you added:</h3>
        <div class="container">
        <div class="row">
            @foreach ($user->books as $book)
                    <div class="col-lg-4 mb-4 border">    
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <a href="{{route('books.show', $book->id)}}">
                                    <img src="{{$book->cover_photo}}" alt="book id {{$book->id}}" class="grid-img">
                                </a>                            
                            </div>
                            <div class="col-auto">
                                
                                <a href="{{route('books.show', $book->id)}}" class="text-decoration-none text-dark h3">
                            
                                    {{$book->title}}
                                </a>
                            </div>
                            <div class="col-auto text-truncate">
                                <h3>
                                @foreach ($book->bookAuthor as $book_author)
                                {{$book_author->author->name}} 
                                </h3>
                                @endforeach
                            </div>
                            <div class="col-6">
                                @foreach ($book->bookCategory as $book_category)
                                <span class="badge bg-secondary bg-opacity-50">{{$book_category->category->name}}</span>
                                    
                                @endforeach
                            </div>
                            <div class="col-6 text-end">
                                {{-- add button -> add review --}}
                                <a href="{{route('reviews.add', $book->id)}}" class="btn btn-success">
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