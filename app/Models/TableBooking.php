<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

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
        'booking_id'
    ];

 protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $booking->booking_id = $booking->generateBookingId();
        });
    }

    public function generateBookingId()
    {
        return 'TBK-' . now()->format('YmdHis') . '_' . strtoupper(Str::random(6));
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    protected function bookingDatetime(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Carbon::parse($value)->format('Y-m-d H:i:s'),
            get: fn($value) => $value ? Carbon::parse($value)->format('l, M d, Y g:i A') : null
        );
    }
}
