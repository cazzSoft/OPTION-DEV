<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_CivilModel extends Model
{
    use HasFactory;
    protected $table = 'estado_civil';
    protected $primaryKey  = 'idestado_civil';
    public $timestamps = false;
}
