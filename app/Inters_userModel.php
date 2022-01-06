<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inters_userModel extends Model
{
    protected $table = 'interes_user';
    protected $primaryKey  = 'idinteres_user';
    public $timestamps = true;
}
