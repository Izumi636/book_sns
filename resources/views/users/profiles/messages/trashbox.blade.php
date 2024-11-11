@extends('layouts.app')

@section('title', 'Trashbox')

@section('content')
    <div style="margin-top: 100px">

        @include('users.profiles.messages.header')

            <div class="card mx-auto border-0 shadow-none bg-white mt-3">
                <div class="card-header">
                    The messages <span class="fw-bold fs-5 text-decoration-underline">you delete</span>
                </div>
                <div class="card-body">
                    @forelse ($trash_messages as $m)
                    <ul>
                        <li>
                            <div class="row my-3">
                                <div class="col-auto">
                                    <button class="btn border bg-transparent text-dark" data-bs-toggle="modal" data-bs-target="#delete-message-{{$m->id}}">
                                        {{$m->sender->name}} 
                                    send '{{$m->title}}'
                                    {{date('M d, Y', strtotime($m->created_at))}}
                                </button>
                                @include('users.profiles.messages.trash-modal')
    
                                </div>
                                <div class="col-auto">
                                    <form action="{{route('messages.restore', $m->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-outline-warning border-0 btn-sm py-1">Restore</button>
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