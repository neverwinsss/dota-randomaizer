<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['name', 'info', 'photo'];

    // Отключаем обязательные столбцы времени
    public $timestamps = false;
}