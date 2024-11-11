@extends('layouts.app')

@section('title', 'Add Review')

@section('content')
<div style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-6 mb-4 border me-3">
                <div class="row">
                    
                    {{-- title / author name --}}
                    <h3>{{$book->title}} / 
                    @foreach ($book->bookAuthor as $book_author)
                    {{$book_author->author->name}}
                
                    @endforeach
                    </h3>
                </div>
                <div class="row mt-2">
                    {{-- cover_photo --}}
                    <img src="{{$book->cover_photo}}" alt="post id {{$book->id}}">
                </div>
                {{-- categories --}}
                <div class="row mt-2">
                    <div class="col-6">
                        @foreach ($book->bookCategory as $book_category)
                            <span class="badge bg-secondary bg-opacity-50">{{$book_category->category->name}}</span>                            
                        @endforeach
                    </div>
                </div>    
            </div>
            <div class="col-md-5 mb-4">
                <form action="{{route('reviews.store', $book->id )}}" method="post">
                    @csrf
                    <div class="row mt-2">
                        <label for="body" class="form-label">Your Review</label>
                        <textarea name="body" id="body" rows="5" placeholder="Enter your review" class="form-control"></textarea>
                    </div>
                    <div class="row mt-2">
                        <label for="stars" class="form-label">Stars</label>
                        <select name="stars" id="stars" class="form-select form-select-lg" aria-label=".form-select-lg stars">
                            <option selected>Put stars</option>
                            <option value="1">★1</option>
                            <option value="2">★2</option>
                            <option value="3">★3</option>
                            <option value="4">★4</option>
                            <option value="5">★5</option>
                        </select>
                    </div>
                    <div class="row mt-5">
                        <button type="submit" class="btn btn-success">Post this review</button>
                    </div>
                </form>
            </div>
        </div>
@endsection