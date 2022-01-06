<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TituloModel extends Model
{
    //titulos
    protected $table = 'titulos';
    protected $primaryKey  = 'idtitulos';
    public $timestamps = false;
}
