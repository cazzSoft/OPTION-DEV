<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponenteModel extends Model
{
    use HasFactory;
    protected $table = 'componente';
    protected $primaryKey  = 'componente';
    public $timestamps = false;
}
