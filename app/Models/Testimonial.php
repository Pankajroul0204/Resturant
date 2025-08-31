<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'image',
        'message',
        'stars',
        'display',
        'approved_by',
    ];

    protected $appends = [
        'image_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset($this->image):'';
    }
}
