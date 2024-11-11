@extends('layouts.app')

@section('title', 'Show Group')
@section('content')
   <div class="card mt-5">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4>{{$group->name}}</h4>
                    <span>{{$group->user->name}}</span>
                </div>
                <div class="col-6"> 
                    @if ($group->user_id === Auth::user()->id)
                    <button type="submit" class="btn btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#edit-group-{{$group->id}}">
                        <i class="far fa-pen-to-square"></i>Edit
                    </button>
                    <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-group-{{$group->id}}">
                        <i class="far fa-trash-can"></i>delete
                    </button>
                    @elseif($group->user_id != Auth::user()->id)
                        @if ($group->user->isJoined())
                        <form action="{{route('leave', $group->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-secondary">Leave this group</button>
                        </form>
                        @elseif(!$group->user->isJoined())
                        <form action="{{route('join', $group->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-info text-white btn-lg">Join</button>
                        </form>
                        @endif
                    @endif

                    {{-- include modal --}}
                    @include('users.groups.action-modal')

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <img src="{{$group->image}}" alt="group image {{$group->id}}" class="grid-img">
                </div>
                <div class="col-6">
                    <h4>{{$group->name}}</h4>
                    <span>created by {{$group->user->name}} </span>
                    <span>{{date('M d, Y', strtotime($group->created_at))}}
                    <p>the number of members: </p>
                    <p>{{$group->description}}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{-- comments --}}
            @include('users.groups.comments')
        </div>
      
    </div>
@endsection