<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable = [
        'category',
        'category_description',
        'category_image',
        'dealing',
    ];
}
