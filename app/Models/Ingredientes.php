<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    public $cantidad = 0;

    protected $table = 'ingredientes';
    protected $primaryKey = 'idIngrediente';
    protected $fillable = [
        'idCategoria', 'marca', 'precio', 
        'cantidadTotal', 'cantidadDisponible', 'posicion',
        'precioCompra', 'precioVenta'
    ];

    public function ingPos(){
        return $this->hasMany(IngredientePosicion::class, 'idIngrediente', 'idIngrediente');
    }

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function($model){
            $ingPos_list = $model->ingPos;

            $cantidad = 0;
            foreach($ingPos_list as $ingPos)
                $cantidad += $ingPos->cantidad;

            $model->cantidad = $cantidad;
        });
    }   
}
