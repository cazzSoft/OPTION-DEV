<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AportacionesModel extends Model
{
    
    protected $table = 'aportaciones';
    protected $primaryKey  = 'idaportaciones';
    public $timestamps = true;
    protected $appends = ['idaportaciones_encryp'];

    public function usuario()
    {
        return $this->hasMany('App\User', 'id', 'iduser');
    }

    //encritamos el id
    public function getIdaportacionesencrypAttribute()
    {
        return encrypt($this->attributes['idaportaciones']);
    }
}
