<?php

namespace App\Models;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'meals_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function meal() {
        return $this->belongsTo(Meal::class, 'meals_id');
    }

}
