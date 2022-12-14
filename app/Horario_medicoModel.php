<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario_medicoModel extends Model
{
    use HasFactory;
    protected $table = 'horario_medico';
    protected $primaryKey  = 'idhorario_medico';
    public $timestamps = true;
    protected $appends = ['idhorario_medico_encrypt'];


     public function horario_dias()
    {
        return $this->hasMany('App\Horario_diasModel', 'idhorario_medico', 'idhorario_medico')->with('dias');
    }

    // id encrpth
    public function getIdhorarioMedicoEncryptAttribute()
    {
        return encrypt($this->attributes['idhorario_medico']);
    }
}
