<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
