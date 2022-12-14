<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetaCita_DetalleModel extends Model
{
    use HasFactory;
    protected $table = 'targetacita_detalletargeta';
    protected $primaryKey  = 'idtargetaCita_DetalleTargeta';
    public $timestamps = false;

    public function targeta_cita()
    {
        return $this->hasMany('App\Targeta_citaModel', 'idtargeta_cita', 'idtargeta_cita');
    }

    public function detalle_targeta()
    {
        return $this->hasMany('App\Detalle_targetaModel', 'iddetalle_tageta', 'iddetalle_tageta');
    }

}
