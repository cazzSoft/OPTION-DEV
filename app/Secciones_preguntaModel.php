<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secciones_preguntaModel extends Model
{
    use HasFactory;
    protected $table = 'secciones_pregunta';
    protected $primaryKey  = 'idsecciones_pregunta';
    public $timestamps = false; 
    // protected $appends = ['idarticulo_encryp'];

    public function pregunta()
    {
        return $this->hasMany('App\PreguntaModel', 'idpregunta', 'idpregunta')->with('opciones_pregunta','componentes','tipoPregunta');
    }
    
    public function seccion()
    {
        return $this->hasMany('App\SeccionesModel', 'idsecciones', 'idsecciones');
    }
}
