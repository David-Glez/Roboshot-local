<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recetas extends Model
{
    protected $table = 'recetas';
    protected $primaryKey = 'idReceta';
    protected $fillable = [
        'nombre', 'descripcion', 'precio','activa', 'img'
    ];
}
