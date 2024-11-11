<div class="modal fade" id="sent-message-{{$m->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-info">
            <div class="modal-header border-info">
                <div class="modal-title">
                    <div class="row">
                        <div class="col-auto">
                            <p class="fs-3">'{{$m->title}}'</p>
                            
                        </div>
                    
                    </div>

                    {{-- user and avatar --}}

                    {{-- when the message sent --}}
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-1">
                        To
                    </div>
                        <div class="col-auto text-start">
                            <a class="text-decoration-none text-dark" href="{{route('profiles.show', $m->id)}}">
                            @if ($m->recipient->avatar)
                            <img src="{{$m->recipient->avatar}}" alt="{{$m->recipient->name}}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
                            @else
                            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-xs"></i>
                            @endif
                            
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{route('profiles.show', $m->recipient->id)}}" class="text-decoration-none text-dark">{{$m->recipient->name}}</a>

                    </div>
                </div>
                <br></br>
                <p class="fs-3">{{$m->message}}</p>
            </div>
            <div class="modal-footer">
                <p class="text-start">{{date('M d, Y', strtotime($m->created_at))}}</p>

                <a href="{{route('messages.add', $m->recipient->id)}}" class="btn btn-info text-white">Send another message</a>
            </div>

        </div>
    </div>
</div>