<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ventas';
    protected $fillable = [
        'total','ganancia', 'fecha', 'online'
    ];
}
