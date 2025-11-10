<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable=[
        "heading",
        "description",
        "cook_quotes",
        "year_of_establishment",
        "image1",
        "image2",
        "chef_id"
    ];

    public function chef()
    {
        return $this->belongsTo(Chef::class);
    }
}
