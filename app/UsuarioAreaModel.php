<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioAreaModel extends Model
{
    //user_area
    protected $table = 'user_area';
    protected $primaryKey  = 'iduser_area';
    public $timestamps = false;
}
