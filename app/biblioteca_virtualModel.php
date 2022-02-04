<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class biblioteca_virtualModel extends Model
{
    protected $table = 'biblioteca_virtual';
    protected $primaryKey  = 'idbiblioteca_virtual';
    public $timestamps = true; 
    protected $appends = ['idbibliotecavirtual_encryp'];

     public function getIdbibliotecavirtualencrypAttribute()
    {
        return encrypt($this->attributes['idbiblioteca_virtual']);
    }

     public function especialidad()
    {
        return $this->belongsTo('App\EspecialidadesModel', 'idespecialidades', 'idespecialidades');
    }
}
