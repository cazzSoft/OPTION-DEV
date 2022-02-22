<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use App\TipoUserModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey  = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'email','password','telefono' ,'fecha_nacimiento','genero','idciudad', 'nom_referido' ,
            'tine_hijo',
            'termino' ,
            'idtipo_user' ,'social_id','social_name','social_avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

 //    public function persona(){
	//     return $this->hasMany('App\PersonaModel', 'idpersona', 'idpersona');
	// }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
       if(auth()->user()->social_avatar){
            return auth()->user()->social_avatar;
       }
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        return auth()->user()->email;
    }

    public function adminlte_profile_url()
    {
        
        if(isset(auth()->user()->idtipo_user)){
            $consul=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
            if($consul=='dr'){
               return 'medico/show';     
            }
        }
        return 'profile/perfil';
    }

    public function ciudad()
    {
        return $this->hasOne('App\CiudadModel', 'idciudad', 'idciudad');
    }
    
    public function seguir()
    {
        return $this->hasMany('App\SeguirModel', 'iduser', 'id');
    }

    public function tìpoUser()
    {
        return $this->belongsTo('App\TipoUserModel', 'idtipo_user', 'idtipo_user');
    }

    public function titulo()
    {
        return $this->belongsTo('App\TituloModel', 'idtitulo_profesional', 'idtitulos');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
}

