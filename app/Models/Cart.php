<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'book_id'];
    protected $table = 'carts';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book() 
    {
        return $this->belongsTo(Book::class);
    }
}

