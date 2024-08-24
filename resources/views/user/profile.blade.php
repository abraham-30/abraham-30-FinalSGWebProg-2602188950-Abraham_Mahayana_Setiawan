@extends('layout.layout')

@section('pageTitle', 'Profile')

@section('content')
<div class="m-5 pt-5">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header p-4">
                    <div class="col-4 mx-auto">
                        <img src="{{ Auth::user()->profilePic }}" alt="" class="rounded mb-3 w-100">
                    </div>
                    <div class="container">
                        <h4 class="text-center fw-bold">{{ Auth::user()->username }}</h4>
                        <h6 class="text-center">{{ Auth::user()->instagramUsername }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <i class="bi bi-gender-ambiguous me-3"></i>{{ Auth::user()->gender }}<br>
                    <i class="bi bi-cake2-fill me-3"></i>{{ Auth::user()->age }}<br>
                    <i class="bi bi-telephone-fill me-3"></i>{{ Auth::user()->mobileNumber }}
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="container">
                        <h4>Wishlist</h4>
                    </div>
                </div>
                <div class="card-body">
                    @forelse ($wishlists as $item)
                    <div class="card" style="border-width:0;">
                        <div class="card-body p-1">
                            <div class="row w-100">
                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                    <img src="{{ $item->profilePic }}" alt="" class="rounded" style="width:75%">
                                </div>
                                <div class="col-md-10 d-flex align-items-center fs-5">
                                    {{ $item->username }}
                                </div>
                                <div class="col-md-1 d-flex justify-content-end align-items-center">
                                    <button class="btn btn-danger">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-3 mx-auto text-center">
                            Empty...
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <div class="container">
                        <h4>Friend List</h4>
                    </div>
                </div>
                <div class="card-body">
                    @forelse ($friends as $item)
                        <div class="card" style="border-width:0;">
                            <div class="card-body p-1">
                                <div class="row w-100">
                                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                                        <img src="{{ $item->profilePic }}" alt="" class="rounded" style="width:75%">
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center fs-5">
                                        {{ $item->username }}
                                    </div>
                                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                                        <button class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#chatModal" data-id="{{ $item->id }}" data-username="{{ $item->username }}">
                                            <i class="bi bi-chat-left-dots"></i>
                                        </button>
                                        <form action="{{ route('deleteFriend', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-3 mx-auto">
                            <a href="{{ route('home') }}">
                                <button class="btn btn-primary w-100">Add New Friends</button>
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <h4>Avatars</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($avatars as $item)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{$item->avatarImg}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{$item->avatarName}}</h5>
                                        <p class="card-text text-truncate">{{$item->avatarDesc}}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-3 mx-auto">
                                <a href="{{ route('avatarShop') }}">
                                    <button class="btn btn-primary w-100">See Avatar Shop</button>
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chat Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Chat with <span id="chat-username"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="chat-box">
                    <div id="messages" style="max-height: 400px; overflow-y: auto;"></div>
                </div>
                <textarea id="message-input" rows="3" class="form-control mt-2" placeholder="Type a message..."></textarea>
            </div>
            <div class="modal-footer">
                <button id="send-message" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentReceiverId = null;

        // Function to load messages
        function fetchMessages() {
            if (!currentReceiverId) return;

            fetch('{{ route('chat.fetchMessages') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ receiver_id: currentReceiverId })
            })
            .then(response => response.json())
            .then(data => {
                let messages = '';
                data.forEach(msg => {
                    // Display the sender and message
                    messages += `<div><strong>${msg.sender_id}</strong>: ${msg.message}</div>`;
                });
                document.getElementById('messages').innerHTML = messages;
            })
            .catch(error => console.error('Error fetching messages:', error));
        }

        // Function to send a message
        function sendMessage(message) {
            if (!message || !currentReceiverId) return;

            fetch('{{ route('chat.sendMessage') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ receiver_id: currentReceiverId, message: message })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'Message sent') {
                    document.getElementById('message-input').value = '';
                    fetchMessages();
                }
            })
            .catch(error => console.error('Error sending message:', error));
        }

        // Event listener for chat button
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function () {
                currentReceiverId = this.getAttribute('data-id');
                const username = this.getAttribute('data-username');
                document.getElementById('chat-username').innerText = username;

                fetchMessages();
            });
        });

        // Event listener for send message button
        document.getElementById('send-message').addEventListener('click', function () {
            const message = document.getElementById('message-input').value;
            sendMessage(message);
        });

        // Optional: Fetch messages periodically
        setInterval(fetchMessages, 5000); // Adjust as needed
    });
</script>
@endpush
