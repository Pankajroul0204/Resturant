<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableBooking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'booking_datetime',
        'number_of_people',
        'event_id',
        'special_request',
        'status',
        'table_number',
        'payment_status',
        'amount',
        'payment_method',
        'cancellation_reason',
        'cancelled_at',
        'confirmed_at',
        'completed_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
