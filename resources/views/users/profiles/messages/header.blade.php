<div class="row w-50 mx-auto">
    <div class="col-4">
    <a href="{{route('messages', Auth::user()->id)}}" class="btn btn-info text-white w-100"><i class="fa-solid fa-envelope-open"></i> Inbox <span class="text-white">{{ Auth::user()->messagesAllCounts()}}</span></a>
    </div>
    <div class="col-4">
        <a href="{{route('messages.outbox', Auth::user()->id)}}" class="btn btn-primary w-100"><i class="fa-solid fa-paper-plane"></i> Outbox <span class="text-white">{{ Auth::user()->outboxCounts()}}</span></a>
    </div>
    <div class="col-4">
        <a href="{{route('messages.trashBox', Auth::user()->id)}}" class="btn btn-secondary w-100"><i class="fa-solid fa-trash"></i> TrashBox <span class="text-white">{{ Auth::user()->trashBoxCounts()}}</span></a>
    </div>
</div>
