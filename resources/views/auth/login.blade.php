@extends('layout.master-layout')

@section('title', 'Login')

@section('body-content')
    <div class="d-flex align-items-center  justify-content-center h-100 login">
        <div class="card">
            <div class="card-header bg-primary-subtle fw-bold">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{old('email')}}">
                        @error('email')
                        <div class="form-text text-danger my-0">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password">
                        @error('password')
                        <div class="form-text text-danger my-0">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
