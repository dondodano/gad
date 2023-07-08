<?php

namespace App\Models;

use App\Models\Preliminary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Worksheet extends Model
{
    use HasFactory,  SoftDeletes;

    protected $table = 'worksheets';

    protected $fillable = [
        'schema_id',
        'category_id',
        'preliminary_id',
        'female',
        'male',
    ];


    public function preliminary()
    {
        return $this->belongsTo(Preliminary::class,'preliminary_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($worksheet){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($worksheet)
                ->log('created');
        });

        static::updated(function($worksheet){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($worksheet)
                ->log('updated');
        });

        static::deleted(function($worksheet){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($worksheet)
                ->log('deleted');
        });
    }
}
