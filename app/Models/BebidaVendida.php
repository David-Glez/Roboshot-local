<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IngredienteVendido;
use App\Models\Ingredientes;
use App\Models\Venta;

class BebidaVendida extends Model
{
    //use HasFactory;

    public $timestamps = false;

    protected $table = 'bebidasVendidas';
    protected $fillable = [
        'idVenta','nombre'
    ];

    protected $appends = ['fecha'];
    protected $hidden = ['venta'];

    public function getFechaAttribute()
    {
        return $this->venta->fecha;
    }


    public function ingredientesVendidos()
    {
        return $this->hasMany(IngredienteVendido::class, 'idBebida');
    }


    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idVenta');
    }
}
