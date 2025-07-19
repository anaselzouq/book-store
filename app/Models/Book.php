<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'published_date',
        'sub_category',
        'rating',
        'thumbnail',
        'price',
    ];
    public $timestamps = false;

}
