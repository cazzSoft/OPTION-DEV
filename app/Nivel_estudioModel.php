<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel_estudioModel extends Model
{
    use HasFactory;
    protected $table = 'nivel_estudio';
    protected $primaryKey  = 'idnivel_estudio';
    public $timestamps = false;
}
