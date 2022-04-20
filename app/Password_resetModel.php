<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password_resetModel extends Model
{
    protected $table = 'clave_resets';
    protected $primaryKey  = 'idclave_resets';
    public $timestamps = true;
}
