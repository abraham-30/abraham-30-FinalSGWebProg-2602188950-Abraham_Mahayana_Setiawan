@extends('layout.signin-layout')

@section('content-title', 'LOGIN')

@section('content')
    @if ($errors->any())
        <div class="col-lg-10 col-sm-9 col-10 mx-auto mb-3">
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <form method="POST" action="{{ route("login") }}">
        @csrf
        <div class="col-lg-10 col-sm-9 col-10 mx-auto mb-3">
            <label for="inputUsername" class="form-label fw-bold">Username</label>
            <input type="text" id="inputUsername" name='inputUsername' class="form-control" value="{{ old('inputUsername') }}" required autofocus>
        </div>
        <div class="col-lg-10 col-sm-9 col-10 mx-auto my-3">
            <label for="inputPassword" class="form-label fw-bold">Password</label>
            <input type="password" id="inputPassword"  name="inputPassword" class="form-control" required>
        </div>
        <div class="row col-lg-4 col-md-6 col-sm-8 col-8 mx-auto py-3 g-2">
            <div class="col">
                <a href="{{ route('registerForm') }}" class="btn btn-outline-success w-100">Register</a>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </form>
@endsection