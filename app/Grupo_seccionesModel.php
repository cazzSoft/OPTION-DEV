<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo_seccionesModel extends Model
{
    use HasFactory;
    protected $table = 'grupo_seccion';
    protected $primaryKey  = 'idgrupo_seccion';
    public $timestamps = false;

    public function seccion() 
    {
        return $this->hasMany('App\SeccionesModel', 'idsecciones', 'idsecciones');
    }

     public function grupo() 
    {
        return $this->hasMany('App\GrupoModel', 'idgrupo', 'idgrupo');
    }
}
