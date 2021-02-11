<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientePosicion extends Model
{
    
    protected $table = 'ingredientePosicion';
    protected $primaryKey = 'posicion';
    public $incrementing = false;
    protected $fillable = [
        'idIngrediente', 'posicion', 'cantidad','cantidadTotal'
    ];

    public function posIng(){
        return $this->belongsToMany(Ingredientes::class, 'idIngrediente', 'idIngrediente');
    }
}
