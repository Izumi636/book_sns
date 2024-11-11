@extends('layouts.app')

@section('title', 'Notification')
    
@section('content')
    
<div style="margin-top: 100px;">
    <div class="card w-50 mx-auto" >
        <div class="card-header">
            <h3><i class="fa-solid fa-bell"></i> Notification</h3>
        </div>
        <div class="card-body">
            @forelse ($owner_notifications as $n)
            <ul>
                <li>
                    <a href="{{route('profiles.show', $n->user_id)}}" class="text-dark">{{$n->user->name}}</a> liked your review of 
                    <a href="{{route('reviews.show', $n->review_id)}}" class="text-dark">{{$n->review->book->title}}</a>
                      {{date('M d, Y', strtotime($n->created_at))}}
                      
                      @if ($n->is_read === 0)
                      <form action="{{route('notification.setRead', $n->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="border-0 bg-transparent p-0 text-danger btn-sm">Read</button>
                      </form>
                      @else
                      <form action="{{route('notification.setUnread', $n->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="border-0 bg-transparent p-0 text-secondary btn-sm">Unead</button>
                      </form>

                      
                      @endif
                     
                </li>
            </ul>
            @empty
           
            <h3 class="text-muted text-center">No notifications yet</h3>
            @endforelse
        </div>
    </div>

</div> 
@endsection