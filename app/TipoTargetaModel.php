<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTargetaModel extends Model
{
    use HasFactory;
    protected $table = 'tipo_targeta';
    protected $primaryKey  = 'idtipo_targeta';
    public $timestamps = false;
}
