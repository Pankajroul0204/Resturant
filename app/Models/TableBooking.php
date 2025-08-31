<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableBooking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'booking_date',
        'booking_time',
        'number_of_people',
        'special_request',
    ];
}
