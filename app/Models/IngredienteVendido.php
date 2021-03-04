<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredientes;

class IngredienteVendido extends Model
{
    //use HasFactory;

    public $timestamps = false;

    protected $table = 'ingredientesVendidos';
    protected $fillable = [
        'idVenta','idIngrediente', 'idBebida', 'cantidad', 'precioCompra', 'precioVenta', 'nombre', 'fecha'
    ];
}
