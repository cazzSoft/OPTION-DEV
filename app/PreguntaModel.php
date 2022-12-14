<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaModel extends Model
{
    // use HasFactory;
    protected $table = 'pregunta';
    protected $primaryKey  = 'idpregunta';
    public $timestamps = false; 

    public function opciones_pregunta()
    {
        return $this->hasMany('App\Opciones_preguntaModel', 'idpregunta', 'idpregunta')->with('opciones');
    }
    
    public function componentes()
    {
        return $this->hasMany('App\ComponenteModel', 'idcomponente', 'idcomponente');
    }
    
    public function tipoPregunta()
    {
        return $this->hasMany('App\TipoPreguntaModel', 'idtipo_pregunta', 'idtipo_pregunta');
    }
}
