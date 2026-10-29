<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Разрешаем запись в эти поля
    protected $fillable = ['title', 'specialization', 'description', 'price', 'duration'];
}
