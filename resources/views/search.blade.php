@extends('layouts.app')

@section('title', 'Explore Books')
    
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <p class="h5 text-muted mb-4">Search results for "<span class="fw-bold"> {{$search}}</span>" books</p>
        
            @if ($books->isNotEmpty())
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-lg-4 col-md-6 mb-4 border">
                        <div class="row">
                            {{-- title / author name --}}
                            <a href="{{route('books.show', $book->id)}}" class="text-decoration-none text-dark fw-bold h3">
                                
                                {{$book->title}} / 
                            @foreach ($book->bookAuthor as $book_author)
                            {{$book_author->author->name}}
                        
                            @endforeach
                            </a>
                        </div>
                        <div class="mt-2">
                            {{-- cover_photo --}}
                                <a href="{{route('books.show', $book->id)}}">
                                    <img src="{{$book->cover_photo}}" alt="post id {{$book->id}}" class="grid-img">
                                </a>
                        </div>
                        {{-- categories --}}
                        <div class="row mt-2">
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
        @else
            <h2 class="text-muted text-center">No books yet</h2>
        @endif

        </div>

        <div class="col">
            <hr>
            <p class="h5 text-muted mb-4">Search results for "<span class="fw-bold"> {{$search}}</span>" authors</p>

        @if ($authors->isNotEmpty())
        <div class="row">
            @foreach ($authors as $author)
                <div class="col-lg-4 col-md-6 mb-4 border">
                    <div class="row">
                        <div class="col">
                            <h3>
                                {{ $author->name }}    
                            </h3>                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>
                                @foreach ($author->bookAuthor as $book_author)
                                <a href="{{route('books.show', $book_author->book->id)}}" class="text-decoration-none text-dark">{{ $book_author->book->title}}</a>
                                @endforeach
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('books.show', $book_author->book->id)}}">
                                <img src="{{$book_author->book->cover_photo}}" alt="post id {{$book_author->book->id}}" class="grid-img">
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            @foreach ($book_author->book->bookCategory as $book_category)
                            <span class="badge bg-secondary bg-opacity-50">{{$book_category->category->name}}</span>
                                
                            @endforeach
                        </div>
                        <div class="col-6 text-end">
                            {{-- add button -> add review --}}
                            <a href="{{route('reviews.add', $book_author->book->id)}}" class="btn btn-success">
                                Add Review
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

                
        </div>
            
        @endif
    
        </div>
    </div>
@endsection