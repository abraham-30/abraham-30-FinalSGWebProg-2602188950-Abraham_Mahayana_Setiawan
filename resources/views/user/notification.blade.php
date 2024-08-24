@extends('layout.layout')

@section('pageTitle', 'Notification')
@section('notification-active', 'active')

@section('content')
<div class="container-md mt-5 py-5">
    <h1>Notifications</h1>
    @forelse ($notifications as $notification)
        <div class="alert alert-info {{ $notification->read ? 'alert-secondary' : '' }}">
            <p>
                @if ($notification->type === 'wishlist_request')
                    {{ $notification->related_user_id }} sent you a wishlist request.
                @elseif ($notification->type === 'request_accepted')
                    {{ $notification->related_user_id }} accepted your request.
                @endif
            </p>
            <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
            </form>
        </div>
    @empty
        <p>No notifications.</p>
    @endforelse
</div>
@endsection