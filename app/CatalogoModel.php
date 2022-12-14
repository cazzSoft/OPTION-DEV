<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogoModel extends Model
{
    protected $table = 'catalogo';
    protected $primaryKey  = 'idcatalogo';
    public $timestamps = false;

    public function tipo_catalogo()
    {
        return $this->hasMany('App\TipoCatalogoModel', 'idcatalogo', 'idcatalogo');
    }
}
