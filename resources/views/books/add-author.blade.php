@extends('layouts.app')

@section('title', 'Add Author')
@section('content')
<div class="row">
<h3>Add Author</h3>
</div>

<form action="{{route('authors.store')}}" method="post">
    @csrf
<div class="row gx-2 mb-2">
    <div class="col-10">
        <input type="text" name="name" id="name" placeholder="New author" class="form-control" autofocus>
    </div>

    <div class="col-2">
        <button type="submit" class="btn btn-warning w-100">
            <i class="fas fa-plus"></i>Add
        </button>
    </div>

    <!-- error -->

    @error('name')
    <div class="text-danger small">{{$message}}</div>
    @enderror

</div>
</form>    
</div>
<hr>
@if($all_authors ->isNotEmpty())
<ul class="list-group">
   @foreach($all_authors as $author)
   <li class="list-group-item d-flex align-items-center">
       <p class="mb-0 me-auto">{{$author->name}}</p>

       <!-- action buttons -->
       <a href="{{route('authors.edit', $author->id)}}" class="btn btn-secondary btn-sm" tiitle="edit">
           <i class="fas fa-pen"></i>
       </a>

       <form action="{{route('authors.destroy', $author->id)}}" method="post" class="ms-1">
           @csrf
           @method('DELETE')

           <button type="submit" class="btn btn-danger btn-sm" title="delete">
               <i class="fas fa-trash-can"></i>
           </button>
       </form>
   </li>
   @endforeach
</ul>
@else
<p>No authors yet</p>
@endif


@endsection



<div class="modal fade" id="add-author">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 model-title text-dark">
                    <i class="fas fa-circle exlamation"></i> Add Author
                </h3>
            </div>
        

            <div class="modal-body text-center">
                <form action="#" method="post">
                    @csrf
                    <label for="new_author" class="form-label">Author name</label>
                    <input type="text" name="new_author" id="new_author" class="form-control">
            </div>
            <div class="modal-footer border-0">

                    <button class="btn btn-outline-danger btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>