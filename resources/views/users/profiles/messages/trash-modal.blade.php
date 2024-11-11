<div class="modal fade" id="delete-message-{{$m->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <div class="modal-title">
                    <div class="row">
                        <div class="col-3">
                            <a class="text-decoration-none text-dark" href="{{route('profiles.show', $m->id)}}">
                            @if ($m->sender->avatar)
                            <img src="{{$m->sender->avatar}}" alt="{{$m->sender->name}}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
                            @else
                            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-sm"></i>
                            @endif
                                </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('profiles.show', $m->sender->id)}}" class="text-decoration-none text-dark">{{$m->sender->name}} <span class="fs-3">'{{$m->title}}'</span>
                            </a>
                            <p>{{date('M d, Y', strtotime($m->created_at))}}</p>
                        </div>
                    </div>

                    {{-- user and avatar --}}

                    {{-- when the message sent --}}
                </div>
            </div>
            <div class="modal-body">
                <p class="fs-3">{{$m->message}}</p>
            </div>
            <div class="card-footer text-end">
                <form action="{{route('messages.restore', $m->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="btn btn-warning text-white">Restore</button>
                </form>
            </div>
        </div>
    </div>
</div>