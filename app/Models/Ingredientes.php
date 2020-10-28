<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    protected $table = 'ingredientes';
    protected $primaryKey = 'idIngrediente';
    protected $fillable = [
        'idCategoria', 'marca', 'precio', 
        'cantidadTotal', 'cantidadDisponible', 'posicion',
        'precioCompra', 'precioVenta'
    ];
}
