<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazanModel extends Model
{
    use HasFactory;
    protected $table = 'raza';
    protected $primaryKey  = 'idraza';
    public $timestamps = false;
}
