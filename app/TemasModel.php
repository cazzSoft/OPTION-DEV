<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemasModel extends Model
{
    protected $table = 'temas';
    protected $primaryKey  = 'idtemas';
    public $timestamps = false;
}
