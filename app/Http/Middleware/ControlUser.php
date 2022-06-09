 <?php

namespace App\Http\Middleware;

use App\TipoUserModel;
use Closure;

class ControlUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if( isset(auth()->user()->idtipo_user) ){
            $consul=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
             if($consul=='us'){
                  return redirect('/home');
             }
             if($consul=='dr'){
                 return redirect('/home');
                  return $next($request);
             }  
        }else{
            
          return redirect('/login');
        }

        return $next($request);
    }
}
