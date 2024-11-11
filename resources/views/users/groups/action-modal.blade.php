
{{-- Edit --}}
<div class="modal fade" id="edit-group-{{ $group->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 modal-title text-warning">
                    Edit
                </h3>
            </div>
            <div class="modal-body">
                <form action="{{route('groups.edit', $group->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <label for="name" class="form-label">Name of Group</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name', $group->name)}}">
                        {{-- error --}}
                        @error('name')
                            <p class="text-danger small">{{$message}}</p>
                        @enderror
        
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{old('description', $group->description)}}">
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
                    </div>
            </div>
            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-warning mt-3">Edit</button>
                    
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-group-{{ $group->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-user-check"></i> Delete Group
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to dlete <span class="fw-bold">{{ $group->name }}</span>?
            </div>
            <div class="modal-footer border-0">
                <form action="{{route('groups.delete', $group->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
                </form>
            </div>
        </div>
    </div>
</div>













