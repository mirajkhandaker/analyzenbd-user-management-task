@extends('layout.auth-layout')
@section('title', 'User List')

@section('body-content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <h4 class="m-0">User List</h4>
                @if($routeName == 'users.index')
                <div>
                    <a href="{{route('users.create')}}" class="btn btn-primary btn-sm">Add User</a>
                </div>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
                            <td>
                                @if($user->avatar && file_exists($user->avatar))
                                    <a href="{{asset($user->avatar)}}" target="_blank">
                                    <img src="{{asset($user->avatar)}}" alt="avatar">
                                    </a>
                                @endif
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>
                                @include('user.partial.action')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

