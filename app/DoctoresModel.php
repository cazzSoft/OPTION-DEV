<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctoresModel extends Model
{
    protected $table = 'user_especialidad';
    protected $primaryKey  = 'iduser_especialidad';
    public $timestamps = false;
}
