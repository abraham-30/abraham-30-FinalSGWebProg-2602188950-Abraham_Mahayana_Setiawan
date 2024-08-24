@extends('layout.signin-layout')

@section('content-title', 'REGISTER')

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
    <form method="POST" action="{{ route("register") }}">
        @csrf
        <div class="col-lg-10 col-sm-9 col-10 mx-auto mx-auto mb-3">
            <label for="inputUsername" class="form-label fw-bold">Username</label>
            <input type="text" id="inputUsername" name="inputUsername" class="form-control" aria-describedby="usernameHelpBlock" value="{{ old('inputUsername') }}" required>
            <div id="usernameHelpBlock" class="form-text">
            Your username must be 2-25 characters long
            </div>
        </div>
        <div class="col-lg-10 col-sm-9 col-10 mx-auto my-3">
            <label for="inputPassword" class="form-label fw-bold">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" aria-describedby="passwordHelpBlock" value="{{ old('inputPassword') }}" required>
            <div id="passwordHelpBlock" class="form-text">
            Your password must be 8-20 characters long
            </div>
        </div>
        <div class="col-lg-10 col-sm-9 col-10 mx-auto mx-auto mb-3">
            <label for="inputInstaUsername" class="form-label fw-bold">Instagram Username</label>
            <input type="link" id="inputInstaUsername" name="inputInstaUsername" class="form-control" aria-describedby="instaUsernameHelpBlock" value="{{ old('inputInstaUsername') }}" required>
            <div id="instaUsernameHelpBlock" class="form-text">
            Your instagram username must be in the form of http://www.instagram.com/(your instagram username)
            </div>
        </div>
        <div class="col-lg-10 col-sm-9 col-10 mx-auto my-3">
            <label for="inputGender" class="form-label fw-bold">Gender</label>
            <select id="inputGender" name="inputGender" class="form-select" required>
                <option value="male" {{ old('inputGender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('inputGender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div class="col-lg-10 col-sm-9 col-10 mx-auto my-3">
            <label for="inputMobileNumber" class="form-label fw-bold">Mobile Number</label>
            <input type="text" id="inputMobileNumber" name="inputMobileNumber" class="form-control" aria-describedby="mobileNumberBlock" value="{{ old('inputMobileNumber') }}" required>
            <div id="mobileNumberBlock" class="form-text">
            Your mobile number must be in numerical and in 10 digits
            </div>
        </div>
        <div class="col-lg-10 col-sm-9 col-10 mx-auto my-3 pb-3">
            <label for="inputAge" class="form-label fw-bold">Age</label>
            <input type="text" id="inputAge" name="inputAge" class="form-control" aria-describedby="ageHelpBlock" value="{{ old('inputAge') }}" required>
            <div id="ageHelpBlock" class="form-text">
            Your age must be in numerical
            </div>
        </div>
        <div class="row col-lg-4 col-md-6 col-sm-8 col-8 mx-auto py-3 g-2">
            <div class="col">
                <a href="{{ route('loginForm') }}" class="btn btn-outline-success w-100">Login</a>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </form>
@endsection