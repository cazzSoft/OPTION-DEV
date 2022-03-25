<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionDetalleModel extends Model
{
    protected $table = 'detalle_notificacion';
    protected $primaryKey  = 'iddetalle_notificacion';
    public $timestamps = true;
}
