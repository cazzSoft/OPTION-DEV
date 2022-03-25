<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticiaModel extends Model
{
    protected $table = 'noticia';
    protected $primaryKey  = 'idnoticia';
    public $timestamps = true;
    protected $appends = ['idnoticia_encryp'];


    public function especialidad()
    {
        return $this->hasMany('App\EspecialidadesModel', 'idespecialidades', 'idespecialidades');
    }

    //encritamos el id
    public function getIdnoticiaencrypAttribute()
    {
        return encrypt($this->attributes['idnoticia']);
    }
}
