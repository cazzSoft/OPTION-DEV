<?php

namespace App\Http\Controllers\Auth;

use App\Datos_medicosModel;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\TipoUserModel;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Log;
use Mail;
use Illuminate\Auth\Events\Registered ;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function username(){
      return 'email';
    }

    public function redirectToProvider($driver) 
    {
        return Socialite::driver($driver)->redirect();
    }
    
      
    public function handleProviderCallback($driver)
    {
        
        try {
                $user = Socialite::driver($driver)->user();
                $usuario=User::where('email',$user->getEmail())->first();
               
                //verificamos si existe y damos acceso si no registramos
                if($usuario){
                    auth()->login($usuario);
                    return redirect('coinsultIn');  
                }else{
                   
                    // validaciones requeridas y unicas del campo email
                    $request=[
                       'email' =>$user->getEmail(),
                         // 'email' =>'',
                    ];

                    //REGLAS
                     if(Session::get('language')=='en'){
                        $messages = [ 
                            'email.required' => 'Registration has ended with an error, could not get your email',
                        ];
                     }else{
                        $messages = [
                            'email.required' => 'El registro ha finalizado con un error, no se pudo obtener su correo electrónico',
                        ];
                     }

                    $collection = collect($request);
                    $validator = Validator::make($collection->all(), [
                         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    ],$messages);

                  
                    if ($validator->fails()) {
                        $error= $validator->errors()->first();
                        return redirect('/log-in-paciente')->with(['info'=>$error,'estado'=>'error']);
                    }
                    
                    //registro de usuario paciente
                        $usuario= User::create([
                                'social_id' => $user->getId(),
                                'social_name' => $driver,
                                'social_avatar' => $user->getAvatar(), 
                                'name' => $user->getName(),
                                'email' => $user->getEmail(),
                                'termino' => 1,
                                'idtipo_user' =>TipoUserModel::where('abr','us')->first()->idtipo_user,
                                
                            ]);
                    //regidtro datos medicos
                        $datos_medico= new Datos_medicosModel();
                        $datos_medico->peso='0';
                        $datos_medico->tipo_sangre='ninguno';
                        $datos_medico->talla='0';
                        $datos_medico->iduser=$usuario->id;
                        $datos_medico->enfermedades='Sin registrar';
                        $datos_medico->save();

                        auth()->login($usuario);

                        //envio de mensaje de bienvenida email 
                            try {

                                $de=$usuario->email;
                                Mail::send('mail.send-mail-bienvenida', ['data'=>$usuario], function ($m) use ($de,$usuario) {
                                    $m->to($usuario->email)
                                    ->from('info@option2health.com', 'Option2Health')
                                    ->subject('¡Te damos una cordial bienvenida a la comunidad de Option2Health!');
                                });
                                 logger('send email'.$de);
                                

                            } catch (\Throwable $th) {
                             
                                logger('send email desde register '.$th->getMessage());
                                // return $th->getMessage();
                            }
                       return redirect('coinsultIn'); 
                }
        } catch (\Throwable $th ) {
           return redirect('log-in-paciente');
        }
       
        
        
    }
}
