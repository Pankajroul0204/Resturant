<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['resturant_id', 'related_to', 'image_path'];

    public function resturant()
    {
        return $this->belongsTo(Resturant::class, 'resturant_id');
    }

}
