<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeUsersModel extends Model
{
    protected $table = 'likes_user';
    protected $primaryKey  = 'idlikes_user';
    public $timestamps = true;

    
}
