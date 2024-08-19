<?php

namespace App\Models;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'Detail_size',
        'Detail_price',
        'Detail_weight',
        'meals_id',
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meals_id');
    }
}
