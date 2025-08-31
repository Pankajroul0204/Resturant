<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InTouch extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'contact_no',
        'message',
    ];

}
