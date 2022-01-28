<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro_ActividadModel extends Model
{
    protected $table = 'registro_actividad';
    protected $primaryKey  = 'idregistro_actividad';
    public $timestamps = true;

    public function detalle_historial()
    {
        return $this->hasMany('App\Actividad_userModel', 'idregistro_actividad', 'idregistro_actividad');
    }
}
