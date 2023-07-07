<?php

namespace App\Models;

use App\Models\Preliminary;
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
}
