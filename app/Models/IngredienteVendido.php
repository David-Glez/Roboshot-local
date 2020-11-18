<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredienteVendido extends Model
{
    //use HasFactory;

    public $timestamps = false;

    protected $table = 'ingredientesVendidos';
    protected $fillable = [
        'idVenta','idIngrediente', 'cantidad', 'precioCompra', 'precioVenta', 'nombre', 'fecha'
    ];
}
