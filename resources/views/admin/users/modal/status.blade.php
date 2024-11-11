
{{-- Deactivate --}}
<div class="modal fade" id="deactivate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-user-slash"></i> Deactivate User
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to deactivate <span class="fw-bold">{{ $user->name }}</span>?
            </div>
            <div class="modal-footer border-0">
                <form action="
                {{route('admin.users.deactivate', $user->id)}}
                " method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Activate --}}
<div class="modal fade" id="activate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-user-check"></i> Activate User
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to activate <span class="fw-bold">{{ $user->name }}</span>?
            </div>
            <div class="modal-footer border-0">
                <form action="
                {{route('admin.users.activate', $user->id)}}
                " method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- roleup --}}

<div class="modal fade" id="roleup-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 modal-title text-warning">
                    <i class="fa-solid fa-user-slash"></i> Make the role Admin
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to make <span class="fw-bold">{{ $user->name }} Admin</span>?
            </div>
            <div class="modal-footer border-0">
                <form action="
                {{route('admin.users.setAdminRole', $user->id)}}
                " method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-warning btn-sm">Make {{ $user->name }} Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- roledown --}}
<div class="modal fade" id="roledown-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-user-check"></i> Make User
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to make <span class="fw-bold">{{ $user->name }} user</span>?
            </div>
            <div class="modal-footer border-0">
                <form action="
                {{route('admin.users.setUserRole', $user->id)}}
                " method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success btn-sm">Make {{ $user->name }} user</button>
                </form>
            </div>
        </div>
    </div>
</div>













