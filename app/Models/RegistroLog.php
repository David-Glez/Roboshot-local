<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroLog extends Model
{
    protected $table = 'registroLog';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'fecha', 'hora', 'operacion', 'disparador', 'tabla', 'esquema', 'descripcion', 'anterior', 'nuevo'
    ];
}
