<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetaIngredienteManual extends Model
{
    protected $table = 'recetaIngredienteManual';
    public $incrementing = false;
    protected $fillable = [
        'codPedido', 'idIngrediente', 'cantidad'
    ];
}
