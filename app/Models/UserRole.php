<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends Model
{
    use HasFactory,  SoftDeletes;

    protected $table = 'users_role';

    protected $fillable = [
        'term',
        'is_visibile',
    ];
}
