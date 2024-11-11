@extends('layouts.app')

@section('title', 'Create group')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Create New Group</h3>    
    </div>    

    <div class="card-body">
        <form action="{{route('groups.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <label for="name" class="form-label">Name of Group</label>
                <input type="text" name="name" id="name" class="form-control">
                {{-- error --}}
                @error('name')
                    <p class="text-danger small">{{$message}}</p>
                @enderror

                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" class="form-control">
                {{-- error --}}
                @error('description')
                    <p class="text-danger small">{{$message}}</p>
                @enderror

                <label for="image" class="form-label">Group Image</label>
                <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
                <div id="image-info" class="form-text">
                    The acceptable formats are jpeg, jpg, png, and gif only. <br>
                    Max file size is 1048kb.
                </div>
                {{-- error --}}
                @error('image')
                    <p class="text-danger small">{{$message}}</p>
                @enderror

                {{-- category limit 3 --}}

                <button type="submit" class="btn btn-warning mt-3">Make</button>
            </div>
        </form>
    </div>

</div> 
@endsection