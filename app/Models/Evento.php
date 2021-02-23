<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //use HasFactory;
    protected $fillable = [
        'tipo', 'origen', 'codigo',  'info',
    ];

    public $msg;
    public $evento;
    protected $appends = ['msg', 'evento'];

    public function getMsgAttribute()
    {
        return $this->msg;
    }

    public function getEventoAttribute()
    {
        return $this->evento;
    }

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function($model){
            $model->evento = $model->origen * 100 + $model->codigo;

            $info = json_decode($model->info);

            switch ($model->evento) {
                case 101: //Ingrediente agregado (dar de alta)
                    $model->msg = "Se dio de alta el ingrediente {$info->marca}";
                    break;
                case 102: //Ingrediente removido (dar de baja)
                    $model->msg = "Se dio de baja el ingrediente {$info->marca}";
                    break;
                case 103: //Ingrediente calibrado (modificar cantidad)
                    $model->msg = "Se modifico la cantidad del ingrediente {$info->marca} en la posicion {$info->pos}, de {$info->cantidadPrevia}ml a {$info->cantidadNueva}ml";
                    break;
                case 104: //Botella agotada (posicion)
                    $model->msg = "La botella de {$info->marca} en la posicion {$info->pos} se agoto";
                    break;
                case 105: //Ingrediente agotado (general)
                    $model->msg = "El ingrediente {$info->marca} se agoto";
                    break;
                case 201: //Receta agregada (dar de alta)
                    $model->msg = "Se agrego la receta {$info->nombre}";
                    break;
                case 202: //Receta removida (dar de baja)
                    $model->msg = "Se elimino la receta {$info->nombre}";
                    break;
                case 401: //Venta
                    $model->msg = "Se realizo una venta por {$info->total}, id {$info->id}";
                    break;
                case 402: //Bebiga entregada en bandeja
                    $model->msg = "Se entrego una bebida en la bandeja {$info->bandeja}, del pedido {$info->idVenta}";
                    break;
                case 403: //Bebida recogida
                    $model->msg = "Se recogio una bebida de la bandeja {$info->bandeja}, del pedido {$info->idVenta}";
                    break;
                case 801: //Calibracion robot SCARA
                    $model->msg = "El robot de la celda fue exitosamente calibrado";
                    break;
                case 901: //Arranque sistema de pedidos
                    $model->msg = "Arranque del sistema de pedidos RoboShot. Inicializado";
                    break;
                case 902: //Cierre sistema de pedidos
                    $model->msg = "Cierre del sistema de pedidos RoboShot. Desactivando";
                    break;
                case 903: //Cierre sistema de pedidos
                    $model->msg = "Inicio de sesion del usuario {$info->usuario}";
                    break;
                case 904: //Cierre sistema de pedidos
                    $model->msg = "Cierre de sesion del usuario {$info->usuario}";
                    break;
            }
        });
    }   
}
