<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUserModel extends Model
{
    protected $table = 'tipo_user';
    protected $primaryKey  = 'idtipo_user';
    public $timestamps = false;
}
