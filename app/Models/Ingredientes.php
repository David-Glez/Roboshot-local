<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    protected $table = 'ingredientes';
    protected $primaryKey = 'idIngrediente';
    protected $fillable = [
        'idCategoria', 'marca',  'precioCompra', 'precioVenta'
    ];


    public function ingPos(){
        return $this->hasMany(IngredientePosicion::class, 'idIngrediente', 'idIngrediente');
    }

    public $cantidad;
    public $precioMl;
    protected $appends = ['cantidad', 'precioMl'];

    public function getCantidadAttribute()
    {
        return $this->cantidad;
    }

    public function getPrecioMlAttribute()
    {
        return $this->precioMl;
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

            $model->precioMl = $model->precioVenta / 1000.0;
        });
    }   
}
