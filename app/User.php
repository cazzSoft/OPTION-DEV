<?php

namespace App;

use App\Notificacion;
use App\Notifications\ResetPasswordNotification;
use App\TipoUserModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //obtener img del perfil del usuario
    public function adminlte_image()
    {
       try {
           
           if(isset(auth()->user()->social_avatar)){
                return auth()->user()->social_avatar;
           }else if (isset(auth()->user()->img) && auth()->user()->img!=null) {
                //verificamos foto en local
                $img=\Storage::disk('diskDocumentosPerfilUser')->exists(auth()->user()->img);
                if($img){
                   return asset(auth()->user()->img);     
                }
             return  $url=\Storage::disk('wasabi')->temporaryUrl(
                     auth()->user()->img,
                     now()->addMinutes(3600)
                 );
           }else{
             return 'img/user.png';
           }
       } catch (\Throwable $th) {
            return 'img/user.png';
       }
    }

    // descripcion del tipo de usuario
    public function adminlte_desc()
    {
        if(isset(auth()->user()->idtipo_user)){
            $us=TipoUserModel::find(auth()->user()->idtipo_user)->descripcion;    
            return $us;   
        } 
    }

    //obtener notificaciones
    public function notify()
    {
        if(isset(auth()->user()->id)){
            $listNotify=Notificacion::with('detalle_notificacion')->where('activo',1)->where('iduser',auth()->user()->id)->get();
            $count_notify=Notificacion::where('estado',1)->where('activo',1)->where('iduser',auth()->user()->id)->get()->count();
             return ['count_notify'=>$count_notify ,'listaNotify'=>$listNotify]; 
        }
        return null;
    }
   
    //coinsult actuales count
    public function coins()
    {
         if(isset(auth()->user()->id)){
            $id=auth()->user()->id;
            $coins=CoinsultModel::where('iduser',$id)->with('detalle_coinsult')->get();
            $sum=00;
            foreach ($coins as $key => $value) {
                if (isset($value['detalle_coinsult'])) {
                  $sum=$sum + $value['detalle_coinsult'][0]->punto;
                 } 
            }
            return $sum;
         }
    }

    //coinsult movimientos count
    public function coins_movimiento()
    {
        if(isset(auth()->user()->id)){
            $id=auth()->user()->id;
            $cant=CoinsultModel::where('iduser',$id)->count();
            return $cant;
        }
    }

    // obtener ruta ruta del perfil medico
    public function adminlte_profile_url()
    {
        
        if(isset(auth()->user()->idtipo_user)){
            $consul=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
            if($consul=='dr'){
               return 'medico/perfil';   
               return 'profile/perfil';  
            }
        }
        return 'profile/perfil';
    }

    // obtener tipo user medico
    public function type_user()
    {
        if(isset(auth()->user()->idtipo_user)){
            $consul=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
            if($consul=='dr'){
               return 'dr';   
            }
            return $consul; 
        }
        return 'profile/perfil';
    }

    // obtener top doctores
    public function topMedicos()
    {
        if(isset(auth()->user()->id)){
            $tipo=TipoUserModel::where('abr','dr')->first();
            $listaTopMedico=User::where('idtipo_user',$tipo['idtipo_user'])->where('estado_registro',1)->get();
            return $listaTopMedico;
        }
         
        return null;
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

    

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
}

