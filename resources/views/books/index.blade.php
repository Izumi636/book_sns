@extends('layouts.app')

@section('title', 'All Books')

@section('content')
{{-- show all books from database --}}
<div style="margin-top: 50px;">

    @if ($books->isNotEmpty())
        <div class="row">
            @foreach ($books as $book)
                <div class="col-lg-4 col-md-6 mb-4 border">
                    <div class="row">
                        <div class="col-auto">
                        {{-- title / author name --}}
                        <a href="{{route('books.show', $book->id)}}" class="text-decoration-none text-dark fw-bold h3">
                            
                            {{$book->title}} / 
                        @foreach ($book->bookAuthor as $book_author)
                        {{$book_author->author->name}}
                    
                        @endforeach
                        </a>
                        </div>
                        <div class="col-auto">
                            <p>reviewed <span class="text-decoration-none text-dark fw-bold">{{$book->reviews->count()}}</span>,  added 
                                <a href="{{route('profiles.show', $book->user->name)}}" class="text-decoration-none text-dark fw-bold">{{$book->user->name}}</a>
                                
                                    @if ($book->reviews->isNotEmpty())
                                    <span>, Ave Stars 
                                    <strong>{{$book->average_reviews()}}</strong>
                                    </span>
                                    @else
                                        
                                    @endif
                                   
                                
                            </p>

                        </div>

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
<div style="margin-top: 50px;">
    <form action="{{route('books.create')}}" method="post">
    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#add-book">
        Can't find the book?
    </button>
    </form>
</div>

@include('books.modal.status')
@endsection