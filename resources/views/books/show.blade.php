@extends('layouts.app')

@section('title', "Book Show")
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3>Book Preview</h3>
                </div>
                <div class="col-6 d-flex flex-row-reverse align-item-center">
                    {{-- action button --}}
                    <a href="{{route('books.index')}} " class="btn btn-warning btn-sm p-3">BACK</a>
                    <a href="{{route('books.edit', $book->id)}}" class="btn btn-warning me-2 btn-sm p-3">EDIT THIS BOOK</a>    
                    <a href="{{route('reviews.add', $book->id)}}" class="btn btn-sm btn-success me-2 p-3">ADD REVIEW</a>
                    @if ($book->isFavorite())
                    <form action="{{route('favorite.destroy', $book->id)}}" method="post">
                        @csrf
                        @method('DELETE')
    
                        <button type="submit" class="btn p-0 me-2 btn-sm p-2">
                            <i class="fa fa-star text-warning fa-2x"></i>
                        </button>
                    </form>
                    @else
                    <form action="{{route('favorite.store', $book->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn shadow-none me-2 p-2 text-center">
                            <i class="fa fa-star fa-2x text-secondary"></i>
                        </button>
                    </form>   
                    @endif            
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="col-auto">
                <div class="row">
                    <div class="col-4">
                        <img src="{{$book->cover_photo}}" alt="post id {{$book->id}}" class="grid-img">
                    </div>
                    <div class="col-auto">
                        <h3>{{$book->title}}</h3>
                        <p class="fw-bold"> By
                            @foreach ($book->bookAuthor as $book_author)
                            {{$book_author->author->name}}
                            @endforeach
                        </p>
                        <p>Story: <br>{{$book->story}}</p>
                        @foreach ($book->bookCategory as $book_category)
                            <span class="badge bg-secondary bg-opacity-50">{{$book_category->category->name}}</span>
                                
                            @endforeach

                    </div>
                    <div class="col-auto">
                        {{-- How many reviews has been created --}}
                        <h3>The number of reviews: <span class="text-decoration-none text-dark fw-bold">{{$book->reviews->count()}}</span></h3>
                       
                        <span class="">added by {{$book->user->name}}</span>
                    </div>
        
                </div>
            </div>
        </div>
        <div class="card-footer">
            @include('books.review-user')
        </div>
    </div>
@endsection

