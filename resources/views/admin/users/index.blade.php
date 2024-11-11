@extends('layouts.app')

@section('title', 'Admin: Users')
@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>CREATED AT</th>
                <th>FOLLOWERS</th>
                <th>FOLLOWING</th>
                <th>ROLE</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_users as $user)
                <tr>
                    <td>
                        @if ($user->avatar)
                            <img src="{{$user->avatar}}" alt="{{$user->name}}" class="roundned-circle d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('profiles.show', $user->id)}}" class="text-decoration-none text-dark fw-bold">
                            {{$user->name}}
                        </a>
                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->followers->count()}}</td>
                    <td>{{$user->following->count()}}</td>

                    <td>
                        @if ($user->role_id === 1)
                            <p>Admin</p>
                        @else
                            <p>user</p>
                        @endif
                    </td>
                    <td>
                        {{-- $user->trashed() returns True if the user was soft deleted. --}}
                        @if ($user->trashed())
                            <i class="fa-regular fa-circle text-secondary"></i>&nbsp;Inactive</td>
                        @else
                            <i class="fa-solid fa-circle text-success"></i>&nbsp;Active</td>
                        @endif
                    <td>
                        @if (Auth::user()->id !== $user->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($user->trashed())
                                        <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#activate-user-{{$user->id}}">
                                            <i class="fa-solid fa-user-check"></i>Activate {{$user->name}}
                                        </button>
                           
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{$user->id}}">
                                            <i class="fa-solid fa-user-slash"></i>Deactivate {{$user->name}}
                                        </button>
                                    @endif
                                    @if ($user->role_id === 2)
                                        <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#roleup-user-{{$user->id}}">
                                            <i class="fa-solid fa-user-check"></i>Make {{$user->name}} Admin 
                                        </button>
                           
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#roledown-user-{{$user->id}}">
                                            <i class="fa-solid fa-user-slash"></i>Make {{ $user->name }} User 
                                        </button>
                                    @endif
                                </div>

                            </div>

                            {{-- include modal here --}}
                            @include('admin.users.modal.status')
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{$all_users->links() }}
    </div>
@endsection