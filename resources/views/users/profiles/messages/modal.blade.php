<div class="modal fade" id="show-message-{{$m->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-info">
            <div class="modal-header border-info">
                <div class="modal-title">
                    <div class="d-flex">
                        <div class="me-2">
                            <a class="text-decoration-none text-dark" href="{{ route('profiles.show', $m->sender->id) }}">
                                @if ($m->sender->avatar)
                                <img src="{{ $m->sender->avatar }}" alt="{{ $m->sender->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
                                @else
                                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('profiles.show', $m->sender->id) }}" class="text-decoration-none text-dark">{{ $m->sender->name }} 
                                <span class="fs-4">'{{ $m->title }}'</span>
                            </a>
                            <p>{{ date('M d, Y', strtotime($m->created_at)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <p class="fs-3">{{$m->message}}</p>
            </div>
            <div class="modal-footer">
                <a href="{{route('messages.add', $m->sender->id)}}" class="btn btn-info text-white">reply</a>
            </div>
        </div>
    </div>
</div>