<?php

namespace App\Http\Controllers\Auth;

use App\Datos_medicosModel;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\TipoUserModel;
use App\User;
use App\UsuarioAreaModel;
use App\UsuarioEspecialidadModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers; 

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //validacion de datos

        //REGLAS
         if(Session::get('language')=='en'){
            $messages = [
                'name.required' =>'You must enter your Names and Surnames', 
                'password.min' => 'Password must contain more than 8 characters', 
                'email.unique' => 'Email has already been registered', 
                // 'password.regex' => 'La contraseña debe tener almenos una letra minúscula  y una mayúsculas ', 
                ];
         }else{
            $messages = [
                'name.required' =>'Debe ingresar sus Nombres y Apellidos', 
                'password.min' => 'La contraseña debe contener más de 8 caracteres ', 
                'email.unique' => 'El correo electrónico ya ha sido registrado', 
                // 'password.regex' => 'La contraseña debe tener almenos una letra minúscula  y una mayúsculas ', 
            ];
         }
        
       
       // return $this->validate($data, $rules, $messages);
        return Validator::make($data, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        // 'password' => ['required', 'string', 'min:8', 'regex:/[A-Z]{1}/','regex:/[a-z]{1}/','confirmed'],
                        'password' => ['required', 'string', 'min:8'],
                    ], $messages);
       
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       
       
        $ver=decrypt($data['tp']);

        if($ver=='P'){
            $tipo_us='us';
        }
        if($ver=='M'){
            $tipo_us='dr';
        }
        if($ver=='E'){
            $tipo_us='em';
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'idtipo_user' =>TipoUserModel::where('abr',$tipo_us)->first()->idtipo_user,  
            'password' => Hash::make($data['password']),
            'img' => 'user.png',
        ]);

        // if($ver=='M'){
        //     $res= User::create([
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'telefono' => $data['telefono'],
        //         'fecha_nacimiento' => $data['fecha_nacimiento'],
        //         // 'genero' => $data['genero'],
        //         // 'idciudad' => $data['idciudad'],
        //         'nom_referido' => $data['nom_referido'],
        //         // 'tine_hijo' => $data['tine_hijo'],
        //         'cedula' => $data['cedula'],
        //         'idtitulo_profesional' => $data['idtitulo_profesional'],
        //         'termino' => $data['termino'],
        //         'idtipo_user' =>TipoUserModel::where('abr','dr')->first()->idtipo_user,
                    

        //         'password' => Hash::make($data['password']),
        //         // 'activo' => false,
        //     ]);

        //     //registrar especialidad dl medico DR
        //      if(isset($data['idespecialidades'])){
                
        //          foreach ($data['idespecialidades'] as $key => $value) {
        //             $user_espe=new UsuarioEspecialidadModel();
        //             $user_espe->idespecialidades=$value;
        //             $user_espe->iduser=$res['id'];
        //             $user_espe->save();
        //         }
        //      }
        // }elseif($ver=='E'){
        //         $res= User::create([
        //             'name' => $data['name'],
        //             'email' => $data['email'],
        //             'telefono' => $data['telefono'],
        //             'fecha_nacimiento' => $data['fecha_nacimiento'],
        //             'genero' => $data['genero'],
        //             'razon_socila' => $data['razon_socila'],
        //             'nom_comercial' => $data['nom_comercial'],
        //             'cedula' => $data['cedula'],
        //             'termino' => $data['termino'],
        //             'idtipo_user' =>TipoUserModel::where('abr','em')->first()->idtipo_user,
                        

        //             'password' => Hash::make($data['password']),
        //             // 'activo' => false,
        //         ]);
        //         //registrar Areas a la empresa
        //          if(isset($data['idarea'])){
                    
        //              foreach ($data['idarea'] as $key => $value) {
        //                 $user_area=new UsuarioAreaModel();
        //                 $user_area->idarea=$value;
        //                 $user_area->iduser=$res['id'];
        //                 $user_area->save();
        //             }
        //          }
                
        // }elseif($ver=='P'){
        //     $res= User::create([
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'telefono' => $data['telefono'],
        //         'fecha_nacimiento' => $data['fecha_nacimiento'],
        //         'genero' => $data['genero'],
        //         'idciudad' => $data['idciudad'],
        //         'nom_referido' => $data['nom_referido'],
        //         'tine_hijo' => $data['tine_hijo'],
        //         'termino' => $data['termino'],
        //         'idtipo_user' =>TipoUserModel::where('abr','us')->first()->idtipo_user,
                    
        //         'password' => Hash::make($data['password']),
               
        //     ]);
        // }

        // return $res;
        
    }
}
