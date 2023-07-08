<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schema extends Model
{
    use HasFactory,  SoftDeletes;

    protected $table = 'schemas';

    protected $fillable = [
        'title',
        'definition',
    ];


    public static function boot()
    {
        parent::boot();

        static::created(function($schema){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($schema)
                ->log('created');
        });

        static::updated(function($schema){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($schema)
                ->log('updated');
        });

        static::deleted(function($schema){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($schema)
                ->log('deleted');
        });
    }
}
