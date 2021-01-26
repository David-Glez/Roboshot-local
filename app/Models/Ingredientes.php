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


    public function ingPos(){
        return $this->hasMany(IngredientePosicion::class, 'idIngrediente', 'idIngrediente');
    }

    public $cantidad;
    protected $appends = ['cantidad'];

    public function getCantidadAttribute()
    {
        return $this->cantidad;
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
