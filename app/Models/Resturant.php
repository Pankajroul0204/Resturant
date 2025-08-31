<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resturant extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
