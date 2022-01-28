<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionActividadModel extends Model
{
    protected $table = 'secciones_actividad_navegacion';
    protected $primaryKey  = 'idsecciones_actividad';
    public $timestamps = false;
}
