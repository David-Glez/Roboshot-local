<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BebidaVendida extends Model
{
    //use HasFactory;

    public $timestamps = false;

    protected $table = 'bebidasVendidas';
    protected $fillable = [
        'idVenta','nombre'
    ];
}
