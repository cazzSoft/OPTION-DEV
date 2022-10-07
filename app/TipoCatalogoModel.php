<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCatalogoModel extends Model
{
    protected $table = 'tipo_catalogo';
    protected $primaryKey  = 'idtipo_catalogo';
    public $timestamps = false;

    public function catalogo()
    {
        return $this->hasMany('App\CatalogoModel', 'idcatalogo', 'idcatalogo');
    }
}
