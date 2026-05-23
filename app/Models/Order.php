<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Order.php

class Order extends Model
{
     protected $fillable = ['user_id', 'total_amount', 'total_price', 'status'];



    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }



}
