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
        //RUTA DE ENVIO DE CONTACTO
        Route::post('/send_email_contac', 'PrincipalController@send_email');   

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
         Route::prefix('casos')->group(function () {
            // Route::get('/casos_ex', 'DoctoresController@casos_ex');
            Route::resource('', 'Caso_exController');
            Route::get('detalle/{id}', 'Caso_exController@show');
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
            Route::get('/guia', 'DoctoresController@getGuiaMedico');
            Route::get('/getMedico_filtro/{esp?}', 'DoctoresController@getGuiaMedico_esp');
            Route::get('/paciente', 'DoctoresController@getPaciente');
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

        //RUTAS PARA Noticias
        Route::prefix('noticia')->group(function () {
            Route::resource('new', 'NoticiaController');
            Route::get('/lastOrden', 'NoticiaController@lastOrden');
            Route::get('/ver/{id}', 'NoticiaController@getNoticia');
            Route::get('/estadoNoticia/{id}/{estado}', 'NoticiaController@putEstadonoticia');
        });

        //RUTAS PARA GESTIÓN DE NOTIFICAIÓN
        Route::prefix('notify')->group(function () {
            Route::resource('estado', 'NotificacionController');
            Route::get('getNotify', 'NotificacionController@getNotificacion');
            
        });

        //RUTAS PARA GESTIÓN DEL CALENDARIO
        Route::prefix('calendario')->group(function () {
            Route::resource('/', 'CalendarioController');
            Route::get('/citas', 'CalendarioController@getListaCitas');
            Route::get('/getuser/{search}', 'CalendarioController@obtenerUsuarios');
            Route::get('/form-registro/{str?}', 'CalendarioController@getFormCita');
            Route::get('/usuario/{id}', 'CalendarioController@selectUser');
            Route::get('/infoCalendario', 'CalendarioController@infoCalendario');
            Route::get('/delete/{id}', 'CalendarioController@destroy');
            Route::get('/edit/{id}', 'CalendarioController@edit');
            Route::put('/update/{id}', 'CalendarioController@update');
            Route::get('/email', 'CalendarioController@enviar');
            Route::get('/get_horario/{fecha?}', 'CalendarioController@get_horario_dia');

            Route::get('/fecha', 'CalendarioController@fecha');
            

        });

         //RUTAS PARA GESTION DE INICIAR CITA MEDICAS
        Route::prefix('cita')->group(function () {
            Route::resource('/save', 'CitaMedicaController');
            Route::get('/get/{id}', 'CitaMedicaController@iniciar_cita');
            Route::post('/pacienteUpdate', 'CitaMedicaController@updatePaciente');
            Route::post('/pacienteUpdate_dm', 'CitaMedicaController@updatePaciente_datosMedicos');
            Route::get('/get_ps/{id}/{idcita}', 'CitaMedicaController@getPreguntasSeccion');
            Route::get('/get_pregunta/{id}', 'CitaMedicaController@getPreguntas');
            Route::post('/savePreguntas', 'CitaMedicaController@save_pregunta');
             Route::get('/get_datos_paciente/{id}', 'CitaMedicaController@obtenerPaciente');
        });

         //RUTAS PARA GESTION DE HORARIOS MEDICOS
        Route::prefix('horario')->group(function () {
            Route::resource('/gestion', 'GestionHorarioMedicoController');
            Route::get('/estado/{id}/{est}', 'GestionHorarioMedicoController@estado_horario');
           
        });
         //RUTAS PARA GESTION DE PREFERENCIA DE CUENTA MEDICOS
        Route::prefix('preferencia')->group(function () {
            Route::resource('/gestion', 'PreferenciaCuentaMedicoController');
            
        });
        //RUTAS PARA ESTADISTICAS
        Route::prefix('estadistica')->group(function () {
            Route::resource('/', 'EstadisticaController');
            Route::get('/datos/{anio}', 'EstadisticaController@getDatos');
            
        });

        //RUTAS PARA GESTION BANNERS
        Route::prefix('banner')->group(function () {
            Route::resource('/', 'BannerController');
            Route::get('/lastOrden', 'BannerController@lastOrden');
        });

         //RUTAS PARA GESTION CITAS PACIENTE AGENDAMIENTO
        Route::prefix('agenda')->group(function () {
            Route::resource('cita/', 'AgendaCitaPaciente');
            Route::get('/form_cita/{idtp}', 'AgendaCitaPaciente@datos_agendamiento');
            Route::post('/save', 'CalendarioController@save_cita_paciente');
            Route::get('/horario_cita/{fecha?}', 'AgendaCitaPaciente@get_horario_citas_fechas');
            // Route::get('cita_nueva/{id?}', 'AgendaCitaPaciente@show');

        });


        // RUTA PARA RECUPERAR CONTRASEÑAS
        // Route::get('/passworduser', 'PrincipalController@user_clave');
 
    });

    //rutas de empoderate 
    Route::prefix('empoderate')->group(function () {
        Route::resource('/', 'EmpoderateController');
    });
    
     // Route::get('/colas', 'Registro_ActividadController@colas');

    // Route::get('/prueba', 'Registro_ActividadController@prueba');
   

