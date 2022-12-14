<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_cita_medicaModel extends Model
{
    // use HasFactory;

    protected $table = 'cita_medica';
    protected $primaryKey  = 'idcita_medica';
    public $timestamps = true;
    
}
