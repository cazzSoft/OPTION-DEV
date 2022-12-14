<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneranCalculosModel extends Model
{
    use HasFactory;
    protected $table = 'generan_calculos';
    protected $primaryKey  = 'idgeneran_calculos';
    public $timestamps = false;
    
}
