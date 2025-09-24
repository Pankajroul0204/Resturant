<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Resturant extends Model
{
    protected $fillable = [
        'resturant_name',
        'heading',
        'description',
        'open_interval',
        'open_time_duration_from',
        'open_time_duration_to',
        'booking_status',
        'image',
        'fb',
        'insta',
        'x',
        'you_tube',
        'created_by'
    ];

    protected $primaryKey = 'resturant_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function openTimeDurationFrom(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('h:i A') : null
        );
    }

    protected function openTimeDurationTo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('h:i A') : null
        );
    }
}
