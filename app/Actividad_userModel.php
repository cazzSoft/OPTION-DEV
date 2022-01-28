<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad_userModel extends Model
{
    protected $table = 'actividad_user';
    protected $primaryKey  = 'idactividad_user';
    public $timestamps = true;



    public function desub_actividad()
    {
        return $this->hasMany('App\Actividad_userModel', 'idactividad_padre', 'idactividad_user')->with('desub_actividad');
    }
}
