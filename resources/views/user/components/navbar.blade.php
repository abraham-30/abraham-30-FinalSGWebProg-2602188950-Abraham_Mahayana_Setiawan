<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top shadow-sm navbar-expand-lg px-5">
        <div class="container-fluid">
            <a class="navbar-brand @yield('home-active')" href="{{ route('home') }}">
                <img src="/assets/images/logo/ConnectFriend-logo3.png" alt="ConnectFriend" height="25">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                  <a class="nav-link @yield('home-active')" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @yield('avatar-active')" aria-current="page" href="{{ route('avatarShop') }}">Avatar Shop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @yield('topup-active')" aria-current="page" href="{{ route('topUp') }}">Top Up</a>
                </li>
                @if(Auth::check())
                  <li class="nav-item">
                    <a class="nav-link @yield('notification-active')" aria-current="page" href="{{ route('notifications.index') }}">Notification</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('profile-active') fw-bold" aria-current="page" href="{{ route('profile') }}">{{ Auth::user()->username }}</a>
                  </li>
                  <li class="nav-item fw-bold">
                    <i class="bi bi-coin me-1"></i>{{ Auth::user()->userCoin }}
                  </li>
                @endif
              </ul>
              @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="btn btn-primary px-5">Logout</button>
                </form>
              @else
                <a href="{{ route('loginForm') }}">
                  <button type="submit" class="btn btn-primary px-5">Login</button>
                </a>
              @endif
            </div>
        </div>
      </nav>
</body>
</html>