<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FriendListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthenticationController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');

Route::get('/payment', [AuthenticationController::class, 'payment'])->name('payment');
Route::post('/confirm-payment', [AuthenticationController::class, 'confirmPayment'])->name('confirmPayment');
Route::post('/add-excess', [AuthenticationController::class, 'addExcess'])->name('addExcess');

Route::get('/login', [AuthenticationController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'hasPaid'])->group(function(){
    Route::post('/wishlist/add/{receiverId}', [WishlistController::class, 'addToWishlist'])->name('addToWishlist');
    Route::post('/wishlist/accept/{wishlistId}', [WishlistController::class, 'acceptRequest'])->name('acceptRequest');
    Route::delete('/wishlist/remove/{receiverId}', [WishlistController::class, 'removeFromWishlist'])->name('removeFromWishlist');
    Route::delete('/friends/{id}', [FriendListController::class, 'deleteFriend'])->name('deleteFriend');
    
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    Route::get('/shop', [AvatarController::class, 'index'])->name('avatarShop');
    Route::post('buy-avatar', [AvatarController::class, 'buyAvatar'])->name('buyAvatar');
    
    Route::get('/topup', [TopupController::class, 'index'])->name('topUp');
    Route::post('/topup-coin', [TopupController::class, 'topup'])->name('topUpCoin');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/fetch', [ChatController::class, 'fetchMessages'])->name('chat.fetchMessages');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
});