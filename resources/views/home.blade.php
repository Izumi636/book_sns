@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row gx-5">
        <div class="col-8">
            @forelse ($home_reviews as $review)
                {{-- for review --}}
            <div class="card mb-4">
                {{-- title --}}
                @include('reviews.title')
                {{-- body --}}
                <div class="card-body">
                    <div class="p-0">
                        <a href="{{route('reviews.show', $review->id)}}">
                            <img src="{{$review->book->cover_photo}}" alt="review id {{$review->book->id}}" class="w-100 photo-md">
                        </a>
                    </div>
                    @include('reviews.body')
                </div>


            </div>

            @empty
                <div class="text-center">
                    <h2>Share reviews</h2>
                    <a href="{{route('books.index')}}" class="text-decoration-none">Go find the books</a>
                </div>
    
            @endforelse
        </div>
        
        <div class="col-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="{{route('profiles.show', Auth::user()->id)}}">
                                @if (Auth::user()->avatar)
                                    <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="rounded-circle avatar-md">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i> 
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0">
                            <a href="{{route('profiles.show', Auth::user()->id)}}" class="text-decoration-none text-dark fw-bold">
                                {{Auth::user()->name}}
                            </a>
                        </div>
                        {{-- how many reviews --}}
                        <div class="col-auto ps-0">
                            <a href="{{route('profiles.show', Auth::user()->id)}}" class="text-decoration-none text-dark">
                                <strong>{{Auth::user()->reviews->count()}}</strong> {{Auth::user()->reviews->count() == 1 ? 'review' : 'reviews'}}
                            </a>
                        </div>
            
                
                        {{-- When you registed this app --}}
                        <div class="col-auto pt-3 text-end">
                                <p class="text-upper-case text-muted xsmall">{{date('M d, Y', strtotime(Auth::user()->created_at))}}</p>
                        </div> 
            
                </div> 
            </div>
        </div>
            <div class="card mt-3">
                <div class="card-body">

                
                    @if ($suggested_books)
                    <div class="row">
                        <div class="col-auto">
                            <p class="fw-bold text-secondary">Suggestions for you</p>
                        </div>
                        <div class="col text-end">
                            <a href="{{route('suggestion')}}" class="fw-bold text-dark text-decoration-none">See all</a>
                        </div>
                    </div>
                        
                    @foreach ($suggested_books as $book)
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <div class="row">
                                {{-- title / author name --}}
                                <a href="{{route('books.show', $book->id)}}" class="text-decoration-none text-dark fw-bold h3">
                                    
                                    {{$book->title}} / 
                                @foreach ($book->bookAuthor as $book_author)
                                {{$book_author->author->name}}
                            
                                @endforeach
                                </a>
                            </div>
                            <div class="col-auto">
                                <p>reviewed <span class="text-decoration-none text-dark fw-bold">
                                    {{$book->reviews->count()}}</span></p>
                            </div>
    
                            <div class="row mt-2">
                                <div class="col">
                                    {{-- cover_photo --}}
                                    <a href="{{route('books.show', $book->id)}}">
                                        <img src="{{$book->cover_photo}}" alt="post id {{$book->id}}" class="grid-img">
                                    </a>
                                </div>
                            </div>

                            {{-- categories --}}
                            <div class="row mt-2">
                                <div class="col-6">
                                    @foreach ($book->bookCategory as $book_category)
                                    <span class="badge bg-secondary bg-opacity-50">
                                        {{$book_category->category->name}}</span>
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    Popular books
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($popular_books as $popular_book)
                        <li>
                            <a href="{{route('books.show', $popular_book->id)}}" class="text-decoration-none text-dark">{{$popular_book->title}} by 
                                @foreach ($popular_book->bookAuthor as $book_author)
                                {{$book_author->author->name}}
                            
                                @endforeach

                            </a>

                            <p>reviewed
                                 {{$popular_book->review_count}}
                                </p>
                        </li>
                          
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
     
{{-- </div>  --}}
@endsection
