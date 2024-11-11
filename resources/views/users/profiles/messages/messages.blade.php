@extends('layouts.app')

@section('title', 'Message View')

@section('content')
    <div style="margin-top: 100px">

        @include('users.profiles.messages.header')

        <div class="card mx-auto border-0 shadow-none bg-white mt-3">
            <div class="card-header">
                The messages <span class="fw-bold fs-5 text-decoration-underline">you recieved</span>
            </div>
            <div class="card-body">
                @forelse ($recip_messages as $m)
                <ul>
                    <li>
                        <div class="row my-3">
                            <div class="col-auto">
                                <button class="btn border bg-transparent text-dark" data-bs-toggle="modal" data-bs-target="#show-message-{{$m->id}}">
                                    {{$m->sender->name}} 
                                    send '{{$m->title}}'
                                    {{date('M d, Y', strtotime($m->created_at))}}
                                </button>
                                @include('users.profiles.messages.modal')
                            </div>
                            <div class="col-auto py-0">
                                @if ($m->is_read === 0)
                                    <form action="{{route('messages.setRead', $m->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="border-0 bg-transparent p-0 text-danger btn-sm">Read</button>
                                    </form>
                                @else
                                    <form action="{{route('messages.setUnread', $m->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="border-0 bg-transparent p-0 text-secondary btn-sm">Unread</button>
                                    </form>          
                                @endif
                            </div>
                                    <div class="col-1">
                                <form action="{{route('messages.delete', $m->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-trash"></i></button>
                                </form>

                            </div>
                        </div>
    
                    </li>
                </ul>
                @empty
                <h3 class="text-muted text-center">No massages yet</h3>
                @endforelse
            </div>
        </div>
    </div>

@endsection