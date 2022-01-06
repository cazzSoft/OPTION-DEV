<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuardadoModel extends Model
{
    protected $table = 'guardado';
    protected $primaryKey  = 'idguardado';
    public $timestamps = true;

    public function articulo_user() 
    {
        return $this->hasMany('App\ArticuloModel', 'idarticulo', 'idarticulo')->withCount('like');
    }
}
