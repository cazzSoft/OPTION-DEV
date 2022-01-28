<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
//ruta login
    Route::get('/login', function () {
        return view('auth.login'); 
    });

    Route::get('/', 'PrincipalController@index')->middleware('web2');
   
    //RUTA DE PREGUNTA DE INTERES PARA EL USUARIO
    Route::get('/share/{id}', 'Inters_userController@shareUserInfo');


   // No utilizar las rutas para registro que están incluidas
    Auth::routes(['register' => false]);
     // Redefinimos las rutas de registro con el prefijo deseado
     Route::prefix('sis')->group(function () {
         Route::get('register/{srt?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
         Route::post('register', 'Auth\RegisterController@register'); 
     });


//RUTAS PERMITIDAS PARA DENTRO DE SESSION
    Route::group(['middleware'=>'auth'],function (){

        //ruta del home page 
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/algoritmo', 'HomeController@prueba')->name('home');


        //GESTION USER EDIT
        Route::prefix('profile')->group(function () {
            Route::resource('/user', 'HomeController'); 
            Route::resource('/perfil', 'PerfilUsuarioController'); 
            Route::get('/show_info', 'PerfilUsuarioController@show_info');
            
        });


        //ruta coinsults
        Route::resource('coinsult', 'CoinsultController');
        Route::get('/coinsultIn', 'CoinsultController@create');
        Route::get('/verificarLike/{id}', 'HomeController@putLikePoint');

        //GESTION ARTICULO 
        Route::prefix('gestion')->group(function () {
            Route::resource('/articulo', 'ArticuloController');
            Route::post('/publicar', 'ArticuloController@publicar');
            Route::post('/search', 'ArticuloController@getArticulos');
            Route::resource('/articulo_user', 'GuardadoController');
            Route::post('/search_user_art', 'GuardadoController@search_art');
            Route::resource('/caso', 'Caso_exController');
            Route::resource('/coment', 'AportacionesController');
            Route::post('/search_caso', 'Caso_exController@get_casos');
            Route::get('/last_month', 'Caso_exController@get_casos_last_month');
            Route::get('/user_casos', 'Caso_exController@get_user_casos');
            
        });

        //GESTION MEDICO
         Route::prefix('medico')->group(function () {
            Route::resource('/perfil', 'DoctoresController');
            Route::put('/perfil_/{id}', 'DoctoresController@actualiza');
            Route::get('/show', 'DoctoresController@getInfo');
            Route::get('/info/{id}', 'DoctoresController@show_info');
            Route::get('/casos_ex', 'DoctoresController@casos_ex');
            Route::resource('/seguir', 'SeguirController');

         });

        //CONSULTAS DE REGISTRO USERS
         Route::prefix('get')->group(function () {
            Route::resource('/seguir', 'SeguirController');
         });

        //RUTA DE PREGUNTA DE INTERES PARA EL USUARIO
         Route::resource('/interes', 'Inters_userController');

         //RUTA BIBLIOTECA VIRTUAL
         Route::resource('/repositorio', 'DocumentRepository');
        

        //HISTORIAL DE USUARIO 
        Route::prefix('actividades')->group(function () {

            Route::get('/createEventInicial', 'Registro_ActividadController@EventInicial');
            Route::resource('/historial', 'Registro_ActividadController');
            Route::get('/historialDetail/{id}', 'Registro_ActividadController@getDetail'); 
            Route::get('/vermas/{id}', 'Registro_ActividadController@EventVerMas'); 
            Route::get('/shareF/{id}', 'Registro_ActividadController@EventShareF'); 
            Route::get('/shareW/{id}', 'Registro_ActividadController@EventShareW'); 
            Route::get('/contactOnline/{id}', 'Registro_ActividadController@ContactOnline'); 
            Route::get('/contactW/{id}', 'Registro_ActividadController@ContactW'); 
            Route::get('/conoceme/{id}', 'Registro_ActividadController@EventConoceme'); 
            Route::get('/publicaciones/{id}', 'Registro_ActividadController@Eventpublicaciones'); 
            Route::get('/redessociales/{id}/{des?}', 'Registro_ActividadController@EventSociales'); 
            Route::get('/Preguntasomitir', 'Registro_ActividadController@EventOmitir');



        });
           
    });

    Route::get('/colas', 'Registro_ActividadController@colas');

  

  // Auth::routes();
   

