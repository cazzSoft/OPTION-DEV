<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPreguntaModel extends Model
{
    use HasFactory;
    protected $table = 'tipo_pregunta';
    protected $primaryKey  = 'idtipo_pregunta';
    public $timestamps = false; 

}
