<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'idVenta';
    protected $fillable = [
        'idReceta','precio', 'fecha', 'hora',
    ];
}
