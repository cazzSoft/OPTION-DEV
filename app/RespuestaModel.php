<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaModel extends Model
{
    use HasFactory;
     protected $table = 'respuesta';
    protected $primaryKey  = 'idrespuesta';
    public $timestamps = true;
}
