@extends('layouts.app')

@section('title', 'Add Message')

@section('content')

<div class="row">
    <div class="col">
        <h3>sending a message to {{$recipient->name}}</h3>
    </div>
</div>

<div class="row">
    <form action="{{route('messages.store', $recipient->id)}}" method="post">
        @csrf
        <div class="col mt-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="col mt-3">
            <label for="message" class="form-label">message</label>
            <textarea name="message" id="message" rows="5" class="form-control"></textarea>
        </div>
        <div class="col mt-3">
            <button type="submit" class="btn btn-info text-white">Send</button>
            <a href="{{route('profiles.show', $recipient->id)}}" class="btn btn-secondary">Cancel</a>
            {{-- going back to profile, route('profiles.show', $recipient_id)? --}}
        </div>
    </form>
</div>
@endsection