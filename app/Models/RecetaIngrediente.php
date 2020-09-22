<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetaIngrediente extends Model
{
    protected $table = 'recetaIngrediente';
    protected $fillable = [
        'idReceta', 'idIngrediente', 'cantidad',
    ];
}
