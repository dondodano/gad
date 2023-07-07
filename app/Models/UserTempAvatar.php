<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTempAvatar extends Model
{
    use HasFactory,  SoftDeletes;


    protected $table = 'users_temp_avatar';

    protected $fillable = [
        'user_id',
        'avatar',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
