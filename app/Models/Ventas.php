<?php

// TODO: Delete this

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'idVenta';
    protected $fillable = [
        'idReceta','precio','ganancia', 'fecha', 'hora',
    ];
}
