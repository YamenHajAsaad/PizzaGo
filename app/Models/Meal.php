<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Detail;
use App\Models\Favorite;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'meals_name',
        'meals_descrption',
        'meals_image',
        'meals_pattern',
        'catgories_id',
    ];

    public function details()
    {
        return $this->hasMany(Detail::class,'meals_id');
    }

    // Meals Model
    public function favorites() {
        return $this->hasMany(Favorite::class,'meals_id');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_details');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class,'meals_id');
    }

}

