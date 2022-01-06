<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeguirModel extends Model
{
    protected $table = 'seguir';
    protected $primaryKey  = 'idseguir';
    public $timestamps = true;

     public function usuarios()
    {
        return $this->hasMany('App\User', 'id', 'iduser_medico');
    }
}
