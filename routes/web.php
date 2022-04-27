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
        return view('login-registro.info-login');  
    });

//rutas del login de redes sociales
    Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider');
    Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');
  

//RUTAS DE INFORMACION PUBLICA SIN LOGIN
    Route::group(['middleware'=>'web2'],function (){ 
         Route::get('', 'PrincipalController@index');
         Route::get('/session', 'PrincipalController@infoLogin')->middleware('translate');
         Route::get('/log-in-paciente', 'PrincipalController@login_paciente')->middleware('translate');
         Route::get('/log-in-medico', 'PrincipalController@login_medico')->middleware('translate');
         Route::get('/log-in-empresa', 'PrincipalController@login_empresa')->middleware('translate');
        //RUTA PARA RECUPERAR CONTRASEÑAS
            Route::resource('/password_reset', 'PasswordResetController')->middleware('translate');
            // Route::get('/insert-code', 'PasswordResetController@insertCode')->middleware('translate');
            Route::post('/reset', 'PasswordResetController@resetPassword')->middleware('translate'); 
            Route::get('/reenviar/{email?}', 'PasswordResetController@resend_code');    
            // Route::get('/edit-email', 'PasswordResetController@reset');
    });
   
   
    Route::post('/lang','IdiomaControlle@translate')->name('language');
    Route::get('/nosotros', 'PrincipalController@aboutme')->middleware('translate');
    Route::get('/info-coinsults', 'PrincipalController@info_coinsults')->middleware('translate');
    Route::post('/search', 'PrincipalController@search');
    Route::get('/faq', 'PrincipalController@faq'); 



    //RUTA DE PREGUNTA DE INTERES PARA EL USUARIO
    Route::get('/share/{id}', 'Inters_userController@shareUserInfo');


   // No utilizar las rutas para registro que están incluidas
    Auth::routes(['register' => false]);
     // Redefinimos las rutas de registro con el prefijo deseado
     Route::prefix('sis')->group(function () {
         Route::get('register/{srt?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
         Route::post('register', 'Auth\RegisterController@register'); 
     });


//RUTAS PERMITIDAS  DENTRO DE SESSION
    Route::group(['middleware'=>'auth'],function (){

        //ruta del home page 
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/algoritmo', 'HomeController@prueba')->name('home');
        Route::get('/nosotros_', 'PrincipalController@aboutme');

        //GESTION USER EDIT
        Route::prefix('profile')->group(function () {
            Route::resource('/user', 'HomeController'); 
            Route::resource('/perfil', 'PerfilUsuarioController'); 
            Route::get('/show_info', 'PerfilUsuarioController@show_info');
            Route::post('/update_photo', 'PerfilUsuarioController@update_photo');
            
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
            Route::get('/resul/{txt?}', 'ArticuloController@resultadoSearch');
            Route::resource('/articulo_user', 'GuardadoController');
            Route::post('/search_user_art', 'GuardadoController@search_art');
            Route::resource('/caso', 'Caso_exController');
            Route::resource('/coment', 'AportacionesController');
            Route::post('/search_caso', 'Caso_exController@get_casos');
            Route::get('/last_month', 'Caso_exController@get_casos_last_month');
            Route::get('/user_casos', 'Caso_exController@get_user_casos');
            Route::get('/listaPublicaciones', 'ArticuloController@getlistaPublicaciones');
            
            
        });

        //GESTION MEDICO
         Route::prefix('medico')->group(function () {
            Route::resource('/perfil', 'DoctoresController');
            Route::put('/perfil_/{id}', 'DoctoresController@actualiza');
            Route::put('/perfil_complet/{id}', 'DoctoresController@updateMedicoPerfil');
            Route::get('/show', 'DoctoresController@getInfo');
            Route::get('/info/{id}', 'DoctoresController@show_info');
            Route::get('/getMedico/{id}', 'DoctoresController@getMedico');
            Route::get('/casos_ex', 'DoctoresController@casos_ex');
            Route::resource('/seguir', 'SeguirController');
            Route::post('/update_portada', 'DoctoresController@update_photo_portada');
            

         });

        //CONSULTAS DE REGISTRO USERS
         Route::prefix('get')->group(function () {
            Route::resource('/seguir', 'SeguirController');
         });

        //RUTA DE PREGUNTA DE INTERES PARA EL USUARIO
        Route::resource('/interes', 'Inters_userController');

         //RUTA BIBLIOTECA VIRTUAL
        Route::prefix('biblioteca')->group(function () {
            Route::resource('/show', 'DocumentRepository');
            Route::get('/repositorio', 'DocumentRepository@show_documento_virtual');
            Route::post('/search', 'DocumentRepository@search_documento');
            Route::get('/view_documento/{id}', 'DocumentRepository@viewDocument');
            Route::get('/download_documento/{id}', 'DocumentRepository@download');
          });
        
        

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
            Route::get('/eventMedicoPerfil', 'Registro_ActividadController@EventMedicoPerfil');
            Route::get('/eventDocumentBiblioteca/{id}', 'Registro_ActividadController@EventBiblioteca');

        });

        //rutas para Noticias
        Route::prefix('noticia')->group(function () {
            Route::resource('new', 'NoticiaController');
            Route::get('/lastOrden', 'NoticiaController@lastOrden');
            Route::get('/ver/{id}', 'NoticiaController@getNoticia');
        });

        //rutas para gestion de Notificacion
        Route::prefix('notify')->group(function () {
            Route::resource('estado', 'NotificacionController');
        });
        
        // RUTA PARA RECUPERAR CONTRASEÑAS
        // Route::get('/passworduser', 'PrincipalController@user_clave');

       

           
    });
    
     // Route::get('/colas', 'Registro_ActividadController@colas');

    Route::get('/prueba/{img}', 'Registro_ActividadController@prueba');
   

