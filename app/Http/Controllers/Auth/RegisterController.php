<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\TipoUserModel;
use App\User;
use App\UsuarioAreaModel;
use App\UsuarioEspecialidadModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
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
        //verificamos que datos validar
        $ver=decrypt($data['tp']);
      
        if($ver=='Médico'){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'telefono' => ['required', 'string', 'max:10'],
                'fecha_nacimiento' => ['required'],
                'termino' => ['required'],
                'idtitulo_profesional' => ['required'],
                'cedula' => ['required','max:13'],
                'nom_referido' => ['required'],
                'detalle_estudio' => ['required'],
                'idespecialidades' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }elseif($ver=='empre'){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'telefono' => ['required', 'string', 'max:10'],
                'fecha_nacimiento' => ['required'],
                'razon_socila' => ['required'],
                'cedula' => ['required', 'string', 'max:13'],
                'genero' => ['required'],
                'nom_comercial' => ['required'],
                'idarea' => ['required'],
                'termino' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'telefono' => ['required', 'string', 'max:10'],
                'fecha_nacimiento' => ['required'],
                'genero' => ['required', 'integer'],
                'idciudad' => ['required', 'string', 'max:11'],
                'termino' => ['required'],
                'tine_hijo' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       
        // dd($data);
         $ver=decrypt($data['tp']);
        if($ver=='Médico'){
            $res= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                // 'genero' => $data['genero'],
                // 'idciudad' => $data['idciudad'],
                'nom_referido' => $data['nom_referido'],
                // 'tine_hijo' => $data['tine_hijo'],
                'cedula' => $data['cedula'],
                'idtitulo_profesional' => $data['idtitulo_profesional'],
                'termino' => $data['termino'],
                'idtipo_user' =>TipoUserModel::where('abr','dr')->first()->idtipo_user,
                    

                'password' => Hash::make($data['password']),
                // 'activo' => false,
            ]);

            //registrar especialidad dl medico DR
             if(isset($data['idespecialidades'])){
                
                 foreach ($data['idespecialidades'] as $key => $value) {
                    $user_espe=new UsuarioEspecialidadModel();
                    $user_espe->idespecialidades=$value;
                    $user_espe->iduser=$res['id'];
                    $user_espe->save();
                }
             }
        }elseif($ver=='empre'){
                $res= User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'telefono' => $data['telefono'],
                    'fecha_nacimiento' => $data['fecha_nacimiento'],
                    'genero' => $data['genero'],
                    'razon_socila' => $data['razon_socila'],
                    'nom_comercial' => $data['nom_comercial'],
                    'cedula' => $data['cedula'],
                    'termino' => $data['termino'],
                    'idtipo_user' =>TipoUserModel::where('abr','em')->first()->idtipo_user,
                        

                    'password' => Hash::make($data['password']),
                    // 'activo' => false,
                ]);
                //registrar Areas a la empresa
                 if(isset($data['idarea'])){
                    
                     foreach ($data['idarea'] as $key => $value) {
                        $user_area=new UsuarioAreaModel();
                        $user_area->idarea=$value;
                        $user_area->iduser=$res['id'];
                        $user_area->save();
                    }
                 }
                
        }else{
            $res= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'genero' => $data['genero'],
                'idciudad' => $data['idciudad'],
                'nom_referido' => $data['nom_referido'],
                'tine_hijo' => $data['tine_hijo'],
                'termino' => $data['termino'],
                'idtipo_user' =>TipoUserModel::where('abr','us')->first()->idtipo_user,
                    
                'password' => Hash::make($data['password']),
               
            ]);
        }

        return $res;
        
    }
}
