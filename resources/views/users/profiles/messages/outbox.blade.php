@extends('layouts.app')

@section('title', 'Message View')

@section('content')
    <div style="margin-top: 100px">

        @include('users.profiles.messages.header')

        <div class="card mx-auto border-0 shadow-none bg-white mt-3">
            <div class="card-header">
                The messages <span class="fw-bold fs-5 text-decoration-underline">you sent</span>
            </div>
            <div class="card-body">
                @forelse ($send_messages as $m)
                <ul>
                    <li>
                        <div class="row my-3">
                            <div class="col-auto">
                                <button class="btn border bg-transparent text-dark" data-bs-toggle="modal" data-bs-target="#sent-message-{{$m->id}}">
                                    You sent '{{$m->title}}' to '{{$m->recipient->name}}'
                                    {{date('M d, Y', strtotime($m->created_at))}}
                                </button>
                                @include('users.profiles.messages.out-modal')

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