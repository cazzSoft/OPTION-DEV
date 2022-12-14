<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoModel extends Model
{
    use HasFactory;
    protected $table = 'grupo';
    protected $primaryKey  = 'idgrupo';
    public $timestamps = false;
    // protected $appends = ['idaportaciones_encryp'];
}
