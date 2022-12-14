<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta_citaModel extends Model
{
    use HasFactory;
    protected $table = 'respuesta_cita';
    protected $primaryKey  = 'idrespuesta_cita';
    public $timestamps = true;
    public function respuesta()
    {
        return $this->hasMany('App\RespuestaModel', 'idrespuesta_cita', 'idrespuesta_cita');
    }
}
