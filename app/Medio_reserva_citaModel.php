<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medio_reserva_citaModel extends Model
{
    protected $table = 'medio_reserva_cita';
    protected $primaryKey  = 'idmedio_reserva';
    public $timestamps = true;
}
