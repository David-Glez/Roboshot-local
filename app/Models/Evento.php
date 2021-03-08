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

            try{
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
                    case 301:
                        $model->msg = "Se envio a preparar la bebida {$info->idBebida}, entregar en bandeja {$info->bandeja}";
                        break;
                    case 302: //Bebiga entregada en bandeja
                        $model->msg = "Se entrego la bebida {$info->idBebida} en la bandeja {$info->bandeja}";
                        break;
                    case 303: //Bebida recogida
                        $model->msg = "Se recogio la bebida {$info->idBebida} de la bandeja {$info->bandeja}";
                        break;
                    case 801: //Arranque sistema de pedidos
                        $model->msg = "Arranque del sistema de pedidos RoboShot. Inicializado";
                        break;
                    case 802: //Cierre sistema de pedidos
                        $model->msg = "Cierre del sistema de pedidos RoboShot. Desactivando";
                        break;
                    case 803: //Cierre sistema de pedidos
                        $model->msg = "Inicio de sesion del usuario {$info->usuario}";
                        break;
                    case 804: //Cierre sistema de pedidos
                        $model->msg = "Cierre de sesion del usuario {$info->usuario}";
                        break;
                    case 901: //Calibracion robot SCARA
                        $model->msg = "El robot de la celda fue exitosamente calibrado";
                        break;
                }
            }catch(Exception $ex)
            {
                $model->msg = "Invalid event. Please contact technical support. Event ID: {$model->id}";
            }

        });
    }   
}
