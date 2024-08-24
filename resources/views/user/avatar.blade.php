@extends('layout.layout')

<link rel="stylesheet" href="/assets/css/avatar-shop-style.css">

@section('pageTitle', 'Avatar Shop')
@section('avatar-active', 'active')

@section('content')
<div class="mt-5">
    <img src="/assets/images/avatar-banner.png" alt="avatar-banner" class="object-fit-cover w-100" height="500">
    <div class="container my-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h3 class="my-3">
            Showcase Your Style: Elevate with Avatars!
        </h3>
        <div class="row row-gap-4 mb-5 pb-5">
            <!-- Loop -->
            @forelse ($avatarsOnSale as $item)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <img src="{{$item->avatarImg}}" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{$item->avatarName}}</h5>
                            <p class="card-text text-truncate">{{$item->avatarDesc}}</p>
                            <form action="{{ route('buyAvatar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="avatar_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-coin me-1"></i>{{ $item->avatarPrice }}
                                </button>
                            </form>
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
</div>
@endsection