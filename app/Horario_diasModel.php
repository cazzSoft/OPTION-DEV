<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario_diasModel extends Model
{
    use HasFactory;
    protected $table = 'horario_dias';
    protected $primaryKey  = 'idhorario_dias';
    public $timestamps = false;

      public function dias()
    {
        return $this->hasMany('App\DiasModel', 'iddias', 'iddias');
    }

     public function horario_medico()
    {
        return $this->hasMany('App\Horario_medicoModel', 'idhorario_medico', 'idhorario_medico');
    }
}
