<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function boot()
    {
        parent::boot();

        static::created(function($settingGeneral){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($preliminary)
                ->log('created');
        });

        static::updated(function($settingGeneral){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($settingGeneral)
                ->log('updated');
        });

        static::deleted(function($settingGeneral){
            activity()
                ->causedBy(Auth::user())
                ->performedOn($settingGeneral)
                ->log('deleted');
        });
    }
}
