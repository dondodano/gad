<?php

namespace App\Models;

use App\Models\Worksheet;
use App\Models\Preliminary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,  SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'title',
    ];

    public function preliminary()
    {
        return $this->belongsTo(Preliminary::class, 'id' , 'category_id');
    }

    public function category_preliminaries()
    {
        return $this->hasMany(Preliminary::class, 'category_id', 'id');
    }

    public function category_worksheets()
    {
        return $this->hasMany(Worksheet::class, 'category_id', 'id');
    }
}
