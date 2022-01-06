<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinsultModel extends Model
{
    protected $table = 'coinsult';
    protected $primaryKey  = 'idcoinsult';
    public $timestamps = true;

    public function detalle_coinsult()
    {
        return $this->hasMany('App\CoinsultDetalleModel', 'idcoinsultDetalle', 'idcoinsultDetalle');
    }
}
