<?php

namespace App\Http\Controllers;

use App\Password_resetModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Log;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;



class PasswordResetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login-registro.passwords.email');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show ($email)
    {
       
        try {
            $email=decrypt($email);
        } catch (\Throwable $th) {
            return view('error.error-404');// vista de error
        }
        return view('login-registro.passwords.code',['email'=>$email]);
    }

   
  

    public function store(Request $request)
    {

        $reset=User::where('email',$request->email)->first();
        
        //generacion de code
        $code = rand(0,999999);

        if(isset($reset)){
            // verificamos que no sea una cuenta de sociales
            if($reset['social_id']!=null){
                return back()->with(['status' => 'Acción no permitida para este email'])->withInput();
            }

            $consul=Password_resetModel::where('email',$request->email)->first();
            if(isset($consul)){
                //generar codigo y notificar
                $consul->token= Hash::make($code);
                $consul->code=$code;
                if($consul->save()){ 
                    //notificamos al usuario
                    $this->notiticar_code_reset_password($consul);
                    return redirect('password_reset/'.encrypt($consul->email));
                }
            }else{
                //registramos y notificamos
                $create= new Password_resetModel();
                $create->email=$request->email;
                $create->token= Hash::make($code);
                $create->code=$code;
                if($create->save()){ 
                    //notificamos al usuario
                    $this->notiticar_code_reset_password($create);
                     return redirect('password_reset/'.encrypt($create->email));
                    return view('login-registro.passwords.code',['email'=>$create->email]);
                }   
            }
        }
       return back()->withErrors(['email' => 'name is required!'])->withInput();
          
    }

    // funcion para notificar por email
    public function notiticar_code_reset_password($data)
    {
        try {

            $so=php_uname();
            $name_nav=$this->getBrowser();
            $user=User::where('email',$data->email)->first();
            $request=[
                    'so'=>$so,
                    'naveg'=>$name_nav,
                    'code'=>$data['code'],
                    'user'=>$user->name,
                    'fecha'=>$data['updated_at']
                ];

                Mail::send('mail.email-reset-password', ['array'=>$request], function ($m) use ($data) {
                    $m->to($data->email)
                    ->from('info@option2health.com', 'Option2Health')
                    ->subject('Restablecer contraseña en Option2health');
                });
                return 1;
        } catch (\Throwable $th) {
           
            logger('send email'.$th->getMessage());
            return $th->getMessage();
        }
    }


    //funcion para detectar el sistema o
    public function getBrowser(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if(strpos($user_agent, 'MSIE') !== FALSE)
            return 'Internet explorer';
        elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
            return 'Microsoft Edge';
        elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
             return 'Internet explorer';
        elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
            return "Opera Mini";
        elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
            return "Opera";
        elseif(strpos($user_agent, 'Firefox') !== FALSE)
            return 'Mozilla Firefox';
        elseif(strpos($user_agent, 'Chrome') !== FALSE)
            return 'Google Chrome';
        elseif(strpos($user_agent, 'Safari') !== FALSE)
            return "Safari";
        else
            return 'Sin resultados';

    }
    

   
    public function edit($id)
    {
        try {
            $id=decrypt($id);
            $consul=Password_resetModel::find($id);

            return view('login-registro.passwords.reset',['token'=>$consul->token,'email'=>$consul->email]);
        } catch (DecryptException $e) {
            return view('error.error-404');// vista de error
        }
    }

    //funcion para reenviar notificacion reset password
    public function resend_code($email)
    {
        try {
                $email=decrypt($email);
                $consul=Password_resetModel::where('email',$email)->first();
               
                if ($this->notiticar_code_reset_password($consul)) {
                    return response()->json([
                        'jsontxt' =>'1',
                    ], 200);
                }
                 return response()->json([
                        'jsontxt' =>'0',
                    ], 500);
               
        } catch (DecryptException $e) {
            return view('error.error-404');// vista de error
        }
    }

   //update password
    public function resetPassword(Request $request)
    {
        
        //función para validar datos
        $request->validate([
            'password' =>  ['required', 'string', 'min:8','confirmed'],
        ]);

        $consul=Password_resetModel::where('email',$request->email)->first();

        if(isset($consul)){
             $consul->delete();
        }

        $user=User::where('email',$request->email)->first();
        $user->password=Hash::make($request['password']);

        if($user->save()){
            auth()->login($user);
            return redirect('/');
        }
    }
    public function update(Request $request, $id)
    {
       
        try {
            $email=decrypt($id);
        } catch (DecryptException $e) {
            return view('error.error-404');// vista de error
        }
           
         // traduccion de mensaje
        $msm='El código ingresado es invalido';
        $msm_expire='El código ha expirado..';

        if(Session::get('language')=='en'){
            $msm='The code entered is invalid';
            $msm_expire='The code has expired';
        }
              
        $consul=Password_resetModel::where('email',$email)->where('code',$request->code)->first();

        if(isset($consul)){
            //comparamos fecha tiempo en restaurar password 10 minutos
            $fecha_naw = new \Carbon\Carbon(date("d-m-Y H:i:00",time()));
            $fehca_ingresada = new \Carbon\Carbon($consul->updated_at);
            
            //de esta manera sacamos la diferencia en minutos
            $minutesDiff=$fecha_naw->diffInMinutes($fehca_ingresada);

            if($minutesDiff<=10){
                return redirect('password_reset/'.encrypt($consul->idclave_resets).'/edit');
            }else{
                return back()->withErrors(['code' => $msm_expire])->withInput();
            }
        }
           return back()->withErrors(['code' => $msm])->withInput(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
