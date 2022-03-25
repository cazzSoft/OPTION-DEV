<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos_medicosModel extends Model
{
    protected $table = 'datos_medico';
    protected $primaryKey  = 'iddatos_medico';
    public $timestamps = true;



    public function user() 
    {
        return $this->hasMany('App\User', 'id', 'iduser');
    }
}
