<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasModel extends Model
{
    use HasFactory;
    protected $table = 'dias';
    protected $primaryKey  = 'iddias';
    public $timestamps = true;
}
