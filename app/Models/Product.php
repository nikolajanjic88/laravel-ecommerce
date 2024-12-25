<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = ['title', 'description', 'price', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasOne(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
