
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
        
        {{-- comments --}}
@include('reviews.comments')
        </div>
