<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaModel extends Model
{
    protected $table = 'prueba';
    protected $primaryKey  = 'idprueba';
    public $timestamps = false;
}
