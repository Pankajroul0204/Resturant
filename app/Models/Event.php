<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_name',
        'event_description',
        'capacity',
        'image',
        'is_displayed',
        'active',
    ];

    static function getEvents()
    {
        return self::where('active', 1)->get();
    }
}
