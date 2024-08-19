<?php

namespace App\Models;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetails extends Model
{
    use HasFactory;

    public function order() {
        return $this->belongsTo(Order::class,'orders_id');
    }
    protected $fillable = [
        'meals_id',
        'details_id',
        'quantity',
        'price_all',
        'orders_id',
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class,'meals_id');
    }

    public function detail() {
        return $this->belongsTo(Detail::class, 'details_id');
    }

}
