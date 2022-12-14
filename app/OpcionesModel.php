<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionesModel extends Model
{
    use HasFactory;
    protected $table = 'opciones';
    protected $primaryKey  = 'idopciones';
    public $timestamps = false; 

     public function opciones()
    {
        return $this->hasMany('App\OpcionesModel', 'idpregunta', 'idpregunta')->with('opciones');
    }
}
