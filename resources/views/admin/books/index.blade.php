@extends('layouts.app')

@section('title', 'Admin: Users')
@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th>TITLE</th>
                <th>AUTHOR</th>
                <th>CATEGORY</th>
                <th>CREATED AT</th>
                <th>REVIEWS</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_books as $book)
                <tr>
                    <td>
                        {{$book->id}}
                    </td>
                    <td>
                        {{$book->title}}
                    </td>
                    <td>
                        @forelse ($book->bookAuthor as $book_author)
                        <span class="badge bg-primary bg-opacity-50">{{$book_author->author->name}}</span>
                
                        @empty
                            <div class="badge bg-dark text-wrap">Uncategorized</bg-dark>
                        @endforelse        
                    </td>
                    <td>
                        @forelse ($book->bookCategory as $book_category)
                        <span class="badge bg-secondary bg-opacity-50">{{$book_category->category->name}}</span>
                
                        @empty
                            <div class="badge bg-dark text-wrap">Uncategorized</bg-dark>
                        @endforelse        
                    </td>
                    <td>{{$book->created_at}}</td>
                    <td>
                        @if ($book->reviews->isNotEmpty())
                            <span>
                                <strong>★{{$book->average_reviews()}}</strong>
                            </span>
                        @else
                            No reviews yet                
                        @endif
                    <td>
                        {{-- $bser->trashed() returns True if the user was soft deleted. --}}
                        @if ($book->trashed())
                            <i class="fa-regular fa-circle text-secondary"></i>&nbsp;Hide</td>
                        @else
                            <i class="fa-solid fa-circle text-success"></i>&nbsp;Unhide</td>
                        @endif
                    <td>
                        {{-- @if (Auth::user()->id !== $user->id) --}}
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($book->trashed())
                                        <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#unhide-book-{{$book->id}}">
                                            <i class="fa-solid fa-book-check"></i>Unhide {{$book->title}}
                                        </button>
                           
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-book-{{$book->id}}">
                                            <i class="fa-solid fa-book-slash"></i>Hide {{$book->title}}
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- include modal here --}}
                            @include('admin.books.modal.status')
                        {{-- @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{$all_books->links() }}
    </div>
@endsection