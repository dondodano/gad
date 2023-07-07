<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingGeneral extends Model
{
    use HasFactory;


    protected $table = 'setting_general';

    protected $fillable = [
        'site_title',
        'site_definition',
        'entity_title',
        'entity_definition',
        'web_icon',
    ];
}
