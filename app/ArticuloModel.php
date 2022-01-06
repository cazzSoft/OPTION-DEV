<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloModel extends Model
{
    protected $table = 'enfermedad';
    protected $primaryKey  = 'idarticulo';
    public $timestamps = true; 
    protected $appends = ['idarticulo_encryp'];

    public function like()
    {
        return $this->hasMany('App\LikeUsersModel', 'idarticulo', 'idarticulo');
    }

    public function getIdarticuloencrypAttribute()
    {
        return encrypt($this->attributes['idarticulo']);
    }

    public function medico()
    {
        return $this->hasMany('App\User', 'id', 'iduser');
    }

    public function comentarios()
    {
        return $this->hasMany('App\AportacionesModel', 'idarticulo', 'idarticulo')->with('usuario');
    }
}
