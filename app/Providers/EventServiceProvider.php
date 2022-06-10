<?php

namespace App\Providers;

use App\TipoUserModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            // SendEmailVerificationNotification::class,
             'App\Listeners\ListenerRegistered',
        ],

        \App\Events\userRegistro::class=>[
            
             'App\Listeners\ActividadRegistro',
        ],


         'Illuminate\Auth\Events\Registered ' => [
            'App\Listeners\ListenerRegistered',
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\SuccessfulLogin',
        ],
        
         'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\UpdateLastLoggedAtOnLogout',
        ],

        \App\Events\HomeEventInfoMedico::class=>[
             'App\Listeners\HomeListenerInfoMedico',
        ],

         \App\Events\HomeEvenMasInfo::class=>[
             'App\Listeners\HomeListenerMasInfo',
        ],

        \App\Events\HomeEventLike::class=>[
             'App\Listeners\HomeListenerLike',
        ],

        \App\Events\HomeEventShare::class=>[
             'App\Listeners\HomeListenerShare',
        ],

        \App\Events\HomeEventGuardar::class=>[
             'App\Listeners\HomeListenerGuardar',
        ],

        \App\Events\HomeEventContact::class=>[
             'App\Listeners\HomeListenerContact',
        ],

         \App\Events\HomeEventSearch::class=>[
             'App\Listeners\HomeListenerSearch',
        ],
        \App\Events\SearchEventResul::class=>[
             'App\Listeners\SearchListenerResul',
        ],

         \App\Events\HomeEventPerfilUser::class=>[
             'App\Listeners\HomeListenerPerfilUser',
        ],

        \App\Events\MedicoEventSeguir::class=>[
             'App\Listeners\MedicoListenerSeguir',
        ],
        \App\Events\MedicoEventSeguirSociales::class=>[
             'App\Listeners\MedicoListenerSeguirSociales',
        ],
        \App\Events\MedicoEventTabsChange::class=>[
             'App\Listeners\MedicoListenerTabsChange',
        ],

        \App\Events\PerfilUserEventUsuario::class=>[
             'App\Listeners\PerfilUserListenerUsuario',
        ],
        \App\Events\PerfilUserEventUsuarioEdit::class=>[
             'App\Listeners\PerfilUserListenerUsuarioEdit',
        ],
        \App\Events\PerfilUserEventUsuarioSeguido::class=>[
             'App\Listeners\PerfilUserListenerUsuarioSeguido',
        ],
        \App\Events\UserEventPreguntaIntere::class=>[
             'App\Listeners\UserListenerPreguntaIntere',
        ],

        \App\Events\MedicoEventPublicacion::class=>[
             'App\Listeners\MedicoListenerPublicacion',
        ],

        \App\Events\UserEventBibliotecaSave::class=>[
             'App\Listeners\UserListenerBibliotecaSave',
        ],

         \App\Events\UserEventSearchBibliotecaFiltro::class=>[
             'App\Listeners\UserListenerSearchBibliotecaFiltro',
        ],
        \App\Events\UserEventBibliotecaAction::class=>[
             'App\Listeners\UserListenerBibliotecaAction',
        ],

        \App\Events\MedicoEventPublicacionesSave::class=>[
             'App\Listeners\MedicoListenerPublicacionesSave',
        ],

        \App\Events\MedicoEventPublicacionesHabilitar::class=>[
             'App\Listeners\MedicoListenerPublicacionesHabilitar',
        ],

        \App\Events\MedicoEventCasoEx::class=>[
             'App\Listeners\MedicoListenerCasoEx',
        ],

        \App\Events\MedicoEventCasoExFiltroSearch::class=>[
             'App\Listeners\MedicoListenerCasoExFiltroSearch',
        ],
         \App\Events\MedicoEventCasoExComent::class=>[
             'App\Listeners\MedicoListenerCasoExComent',
        ],
         \App\Events\SaveImgEvent::class=>[
             'App\Listeners\SaveImgListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
          //Asignamos sus menu de acuerdo al rol
          Event::listen(BuildingMenu::class,function(BuildingMenu $event){
          if(isset(auth()->user()->idtipo_user)){
               $consul=TipoUserModel::find(auth()->user()->idtipo_user)->abr;
               if($consul=='us'){
                    $event->menu->add(
                         [
                           'text' => 'Inicio',
                           'url'  => '/home',
                           'icon' => 'fas fa-fw fa-home',
                           'active' => ['home']
                           
                         ],
                         [
                           'text' => '¿Qué Somos?',
                           'url'  => 'nosotros_',
                           'icon' => 'fa fa-notes-medical',
                         ],
                         [
                           'text' => 'Coinsults',
                           'url'  => 'coinsult',
                           'icon' => 'far fa-copyright',
                         
                         ],
                         [
                           'text' => 'Guardados',
                           'url'  => 'gestion/articulo_user',
                           'icon' => 'fas fa-fw fa-bookmark',
                           
                         ],
                         [
                           'text' => 'Biblioteca',
                           'url'  => 'biblioteca/show',
                           'icon' => 'fas fa-book-reader',
                          
                         ],
                        
                    );
               }else if($consul=='dr'){
                    $event->menu->add(
                         [
                           'text' => 'Inicio',
                           'url'  => '/home',
                           'icon' => 'fas fa-fw fa-home',
                           'active' => ['home']
                           
                         ],
                         [
                           'text' => '¿Qué Somos?',
                           'url'  => 'nosotros_',
                           'icon' => 'fa fa-notes-medical',
                         ],
                         [
                           'text' => 'Coinsults',
                           'url'  => 'coinsult',
                           'icon' => 'far fa-copyright',
                         
                         ],
                         [
                           'text' => 'Guardados',
                           'url'  => 'gestion/articulo_user',
                           'icon' => 'fas fa-fw fa-bookmark',
                           
                         ],
                         [
                           'text' => 'Biblioteca',
                           'url'  => 'biblioteca/show',
                           'icon' => 'fas fa-book-reader',
                          
                         ],
                         [
                           'text' => 'Casos',
                           'url'  => 'gestion/user_casos',
                           'icon' => 'fas fa-briefcase-medical',
                           'active'=> ['gestion/user_casos*','medico/casos_ex*','gestion/search_caso*','gestion/caso*']
                         ],
                        
                    );

               }else if($consul=='ins'){

               }else if($consul=='ad'){

               }
               
          }else{
               $event->menu->add(
                    [
                      'text' => 'Inicio',
                      'url'  => '/',
                      'icon' => 'fas fa-fw fa-home',
                      'active' => ['/']
                      
                    ],
                    [
                      'text' => '¿Qué Somos?',
                      'url'  => 'nosotros',
                      'icon' => 'fa fa-notes-medical',
                    ],
                    [
                      'text' => 'Coinsults',
                      'url'  => 'info-coinsult',
                      'icon' => 'far fa-copyright',
                    
                    ],
                    [
                      'text' => 'Biblioteca',
                      'url'  => 'biblioteca/show',
                      'icon' => 'fas fa-book-reader',
                     
                    ],
                   
               );
          }
        });

        parent::boot();

        //
    }
}
