@extends('layout.auth-layout')
@section('title', 'Edit user')

@section('body-content')
    <div class="container mt-5">
        <form method="post" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card w-75 mx-auto">
                <div class="card-header">Edit User</div>
                <div class="card-body">

                    @include('user.partial.form')

                </div>
                <div class="card-footer">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        <a href="{{route('users.index')}}" class="btn btn-dark btn-sm">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
