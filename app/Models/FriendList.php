<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendList extends Model
{
    use HasFactory;
    protected $table='friend_lists';
    protected $guarded = ['id'];
}
