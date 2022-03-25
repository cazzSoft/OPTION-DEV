<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificacion';
    protected $primaryKey  = 'idnotificacion';
    public $timestamps = true;

    public function detalle_notificacion()
    {
        return $this->hasMany('App\NotificacionDetalleModel', 'iddetalle_notificacion', 'iddetalle_notificacion');
    }
}
