@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Add New Book</h3>    
    </div>    

    <div class="card-body">
        <form action="{{route('books.update', $book->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                       
                {{-- title --}}
                <label for="title" class="form-label">Title of the book</label>
                <input type="text" name="title" id="title" class="form-control" value="{{old('title', $book->title)}}">
                {{-- error --}}
                @error('title')
                    <p class="text-danger small">{{$message}}</p>
                @enderror
                {{-- author --}}
                <label for="author" class="form-label">the author of the book</label>
                <div class="row">
                    @foreach ($all_authors as $author)
                    <div class="col-md-4 mb-2">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="author_id[]" value="{{$author->id}}" id="{{$author->name}}" class="form-check-input">
                            <label for="{{$author->name}}" class="form-check-label">{{$author->name}}</label>
                        </div>

                    </div>
                    @endforeach
                    {{-- adding author --}}
                        <a href="{{route('authors.add')}}" class="btn btn-warning">
                            Can't find the author?
                        </a>
                </div>
                {{-- error --}}
                @error('author_id')
                    <p class="text-danger small">{{$message}}</p>
                @enderror



                {{-- cover photo --}}
                <label for="cover_photo" class="form-label">The cover of the book</label>
                <input type="file" name="cover_photo" id="cover_photo" class="form-control" aria-describedby="image-info">
                <div id="image-info" class="form-text">
                    The acceptable formats are jpeg, jpg, png, and gif only. <br>
                    Max file size is 1048kb.
                </div>
                {{-- error --}}
                @error('cover_photo')
                    <p class="text-danger small">{{$message}}</p>
                @enderror

                {{-- category limit 3 --}}
            
                <label for="category" class="form-label">The category of the book (up to 3)</label>
                <div class="row">
                    @foreach ($all_categories as $category)
                        <div class="col-md-4 mb-2"> 
                            <div class="form-check">
                                <input type="checkbox" name="category_id[]" value="{{$category->id}}" id="{{$category->name}}" class="form-check-input">
                                <label for="{{$category->name}}" class="form-check-label">{{$category->name}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- error --}}
                @error('category_id')
                    <p class="text-danger small">{{$message}}</p>
                @enderror

                <label for="story" class="form-label">Story</label>
                <textarea name="story" id="story" rows="3" class="form-control">{{old('story', $book->story)}}</textarea>

                @error('story')
                    <p class="text-danger small">{{$message}}</p>
                @enderror


                <button type="submit" class="btn btn-warning mt-3">Update</button>
            </div>


        </form>
    </div>

</div> 
@endsection