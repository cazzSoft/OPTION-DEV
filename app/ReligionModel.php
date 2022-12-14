<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReligionModel extends Model
{
    use HasFactory;
    protected $table = 'religion';
    protected $primaryKey  = 'idreligion';
    public $timestamps = true;
    
}
