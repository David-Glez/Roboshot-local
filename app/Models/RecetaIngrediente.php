<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetaIngrediente extends Model
{
    protected $table = 'recetaIngrediente';
    public $incrementing = false;
    protected $fillable = [
        'idReceta', 'idIngrediente', 'cantidad',
    ];
}
