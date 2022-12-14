<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarioModel extends Model
{
    protected $table = 'agenda';
    protected $primaryKey  = 'idagenda';
    public $timestamps = true;
    protected $appends = ['idpaciente_encryp'];
    protected $hidden = ['idpaciente'];

    public function usuario()
    {
        return $this->hasMany('App\User', 'id', 'idpaciente');
    }

    public function detalle_cita()
    {
        return $this->hasMany('App\Detalle_cita_medicaModel', 'idagenda', 'idagenda');
    }

    //encritamos el idpaciente
    public function getIdpacienteencrypAttribute()
    {
        return encrypt($this->attributes['idpaciente']);
    }
}
