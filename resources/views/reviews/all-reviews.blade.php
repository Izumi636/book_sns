@extends('layouts.app')

@section('title', 'All Review')
@section('content')
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
        @if ($suggested_users)
        <div class="row">
            <div class="col-auto">
                <p class="fw-bold text-secondary">Suggestions for you</p>
            </div>
        </div>
            
        @foreach ($suggested_users as $user)
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                @if ($user->avatar)
                    <img src="{{$user->avatar}}" alt="{{$user->name}}" class="rounded-circle avatar-sm">
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif
            </div>
            <div class="col ps-0 text-truncate">
                <a href="
                {{route('profiles.show', $user->id)}}
                " class="text-decoration-none text-dark fw-bold">{{$user->name}}</a>
            </div>
            <div class="col-auto">
                <form action="
                {{route('follow.store',$user->id)}}
                " method="post">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                </form>
            </div>
        </div>
        @endforeach
        @endif

    </div>
</div>
@endsection