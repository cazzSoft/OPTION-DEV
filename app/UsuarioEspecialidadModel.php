<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioEspecialidadModel extends Model
{
    protected $table = 'user_especialidad';
    protected $primaryKey  = 'iduser_especialidad';
    public $timestamps = false;

    public function especialidades()
    {
        return $this->belongsTo('App\EspecialidadesModel', 'idespecialidades', 'idespecialidades');
    }

    public function usuario()
    {
        return $this->hasMany('App\User', 'id', 'iduser')->with('titulo');
    }

}
