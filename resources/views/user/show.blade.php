@extends('layout.auth-layout')
@section('title', 'User Profile')

@section('body-content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header d-flex">
                <h4 class="me-auto">User Profile</h4>
                <div class="ms-auto">@include('user.partial.action')</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        @if($user->profile_pic && file_exists($user->profile_pic))
                            <a href="{{asset($user->profile_pic)}}" target="_blank">
                                <img class="img-fluid" src="{{asset($user->profile_pic)}}" alt="profile-pic">
                            </a>
                        @endif
                    </div>
                    <div class="col-md-5">
                        <p class="text-capitalize m-0 fw-bold">{{$user->name}}</p>
                        <p class="text-capitalize m-0">{{$user->email}}</p>
                        <p class="text-capitalize m-0">{{$user->phone_number}}</p>
                    </div>
                    <div class="col-md-5">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Addresses</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user->addressOnly as $address)
                                <tr>
                                    <td>
                                        <address class="m-0">{{$address}}</address>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td><p class="m-0">No Address Available</p></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
