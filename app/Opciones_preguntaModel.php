<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones_preguntaModel extends Model
{
    use HasFactory;
    protected $table = 'opciones_pregunta';
    protected $primaryKey  = 'idopciones_pregunta';
    public $timestamps = false; 

    

    public function opciones()
    {
        return $this->hasMany('App\OpcionesModel', 'idopciones', 'idopciones');
    }

    public function pregunta_deo()
    {
        return $this->hasMany('App\OpcionesModel', 'idpregunta', 'idpregunta');
    }

}
