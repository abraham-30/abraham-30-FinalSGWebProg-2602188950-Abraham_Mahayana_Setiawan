@extends('layout.layout')

<link rel="stylesheet" href="/assets/css/home-style.css">

@section('pageTitle', 'Home')
@section('home-active', 'active')

@section('content')
<div class="container-md mt-5 py-5">
    <div class="input-group mt-2">
        <form method="GET" action="{{ route('home') }}" class="d-flex w-100">
            <input type="text" class="form-control" placeholder="Search by hobby" aria-label="Search by hobby" aria-describedby="button-search" value="{{request('search')}}">
            <button class="btn btn-outline-secondary" type="button" id="button-search"><i class="bi bi-search"></i></button>
            <button class="btn btn-outline-secondary dropdown-toggle" id="genderFilterDropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ request('gender')?ucfirst(request('gender')) : 'Filter' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="">
                <li><a class="dropdown-item" href="{{ route('home', ['gender' => 'male', 'search' => request('search')]) }}">Male</a></li>
                <li><a class="dropdown-item" href="{{ route('home', ['gender' => 'female', 'search' => request('search')]) }}">Female</a></li>
                <li><a class="dropdown-item" href="{{ route('home', ['gender' => '', 'search' => request('search')]) }}">All</a></li>
            </ul>
        </form>
    </div>
    <h3 class="my-4">
        Connect with Another Casual Friends!
    </h3>
    <div class="row row-gap-4">
        <!-- Loop -->
        @forelse ($users as $item)
        <div class="col-xl-4 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <img src="{{$item->profilePic}}" alt="profile" class="img me-1" width="35">
                            {{$item->username}}
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            @if (in_array($item->id, $excludedUserIds))
                                <form action="{{ route('removeFromWishlist', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
                                </form>
                            @else
                                <form action="{{ route('addToWishlist', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-hand-thumbs-up-fill"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <img src="/assets/images/default-hobby-image.png" alt="hobby" class="object-fit-cover w-100" height="200">
                    <div class="container p-3">
                        <p class="fw-bold">
                            ({{$item->age}} - {{$item->gender}})
                        </p>
                        Hobbies <br>
                        1. Playing Piano <br>
                        2. Playing Guitar <br>
                        3. Playing Drum
                    </div>
                </div>
            </div>        
        </div>
        @empty
            <div class="col-6 mx-auto text-center">
                Empty...
            </div>
        @endforelse
    </div>
</div>
@endsection