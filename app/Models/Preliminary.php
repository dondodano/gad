<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Worksheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preliminary extends Model
{
    use HasFactory,  SoftDeletes;

    protected $table = 'preliminaries';

    protected $fillable = [
        'sequence',
        'category_id',
        'pretext',
        'context',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function worksheet()
    {
        return $this->hasOne(Worksheet::class,'preliminary_id', 'id');
    }

    public function belongworksheet()
    {
        return $this->belongsTo(Worksheet::class, 'id','preliminary_id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($preliminary){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($preliminary)
                ->log('created');
        });

        static::updated(function($preliminary){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($preliminary)
                ->log('updated');
        });

        static::deleted(function($preliminary){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($preliminary)
                ->log('deleted');
        });
    }
}
