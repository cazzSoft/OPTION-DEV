<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_targetaModel extends Model
{
    use HasFactory;
    protected $table = 'detalle_tageta';
    protected $primaryKey  = 'iddetalle_tageta';
    public $timestamps = false;
}
