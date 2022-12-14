<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionesModel extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $primaryKey  = 'idsecciones';
    public $timestamps = false;
}
