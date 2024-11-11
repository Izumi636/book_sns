@extends('layouts.app')

@section('title', 'All group')

@section('content')
{{-- show all groups from database --}}
<div style="margin-top: 50px;">

    @if ($groups->isNotEmpty())
        <div class="row">
            @foreach ($groups as $group)
                <div class="col-lg-4 col-md-6 mb-4 border">
                    <div class="row">
                        <div class="col-auto">
                        <a href="{{route('groups.show', $group->id)}}" class="text-decoration-none text-dark fw-bold fs-3">
                            {{$group->name}} 
                        </a>
                        <span>created 
                            {{$group->user->name}}
                        </span>
                            <span>{{date('M d, Y', strtotime($group->created_at))}}
                        <p>{{$group->description}}</p>
                        </span>
                    </div>
                    </div>
                    <div class="mt-2">
                        {{-- image --}}
                            <a href="{{route('groups.show', $group->id)}}">
                                <img src="{{$group->image}}" alt="group id {{$group->id}}" class="grid-img">
                            </a>
                    </div>
                    
                </div>
            @endforeach
        </div>
    @else
        <h2 class="text-muted text-center">No groups yet</h2>
    @endif


</div> 
<div style="margin-top: 50px;">
    <a href="{{route('groups.create')}}" class="btn btn-warning">
        Create new group?
    </a>
</div>
@endsection