@extends('layouts.app')

@section('tiitle','Edit Task')

@section('content')
<h1 class="h3">Edit Author</h1>
<form action="{{route('authors.update', $author->id)}}" method="post">

    @csrf 
    @method('PATCH')
   
    <div class="row gx-2 mb-2">
       <div class="col-10">
           <input type="text" name="name" id="name" class="form-control" autofocus value="{{old('name', $author->name)}}">
       </div>
   
       <div class="col-2">
           <button type="submit" class="btn btn-warning w-100">
               <i class="fas fa-check"></i>Update
           </button>
       </div>
   
       <!-- error -->
   
       @error('name')
       <div class="text-danger small">{{$message}}</div>
       @enderror
   
   </div>
   
    </form>
   
@endsection