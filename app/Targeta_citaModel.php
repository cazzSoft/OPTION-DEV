<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Targeta_citaModel extends Model
{
    use HasFactory;
    protected $table = 'targeta_cita';
    protected $primaryKey  = 'idtargeta_cita';
    public $timestamps = true;

    public function tipoTargeta()
    {
        return $this->hasMany('App\TipoTargetaModel', 'idtipo_targeta', 'idtipo_targeta');
    }

     public function Targeta_detalle()
    {
        return $this->hasMany('App\TargetaCita_DetalleModel', 'idtargeta_cita', 'idtargeta_cita')->with('detalle_targeta');
    }
}
