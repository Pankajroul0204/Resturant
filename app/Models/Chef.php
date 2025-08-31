<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    protected $fillable=[
        "name",
        "designation",
        "description",
        "signature",
        "achivements",
        "display",
        "modified_by"
    ];
}
