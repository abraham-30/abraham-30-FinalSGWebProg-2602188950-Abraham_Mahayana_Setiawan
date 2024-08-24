@extends('layout.layout')

@section('pageTitle', 'Top Up')
@section('topup-active', 'active')

@section('content')
<div class="container my-5 pt-5">
    <div class="card">
        <img src="/assets/images/coin-background.png" class="card-img-top" alt="">
        <div class="card-body my-3">
            @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            @endif
            <div class="col-6 mx-auto">
                <form method="POST" action="{{ route('topUpCoin') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100">TOP UP!!!</button>
                </form>
            </div>
            <p class="card-text text-center fs-5 mt-3">"Boost your experience instantly—click the button to add 100 coins and enjoy enhanced features and benefits right away!"</p>
        </div>
    </div>
</div>
@endsection