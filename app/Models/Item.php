<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'info', 'photo'];
    // Отключаем обязательные столбцы времени
    public $timestamps = false;
}