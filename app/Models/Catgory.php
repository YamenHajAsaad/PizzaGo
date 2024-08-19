<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catgory extends Model
{
    use HasFactory;

    protected $fillable = [
        'catgories_name',
        'catgories_descrption',
        'catgories_image',
    ];
}



