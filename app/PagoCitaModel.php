<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoCitaModel extends Model
{
    use HasFactory;
    protected $table = 'pago_cita';
    protected $primaryKey  = 'idtargeta_cita';
    public $timestamps = true;
}
