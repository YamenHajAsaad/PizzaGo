<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function orderDetails() {
        return $this->hasMany(OrderDetails::class, 'orders_id');
    }

    public function meals() {
        return $this->belongsToMany(Meal::class, 'order_details');
    }

    protected $fillable = [
        'users_id ',
        'total',
    ];

    // في نموذج Order
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }


}
