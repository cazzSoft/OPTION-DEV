<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoCitaModel extends Model
{
    use HasFactory;
    protected $table = 'archivos_cita';
    protected $primaryKey  = 'idarchivos_cita';
    public $timestamps = true;
}
