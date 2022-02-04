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
                                'active' => ['gestion/articulo', 'medico/info*','gestion/search']
                                
                            ],
                            [
                                'text' => 'Perfil',
                                'url'  => '/profile/perfil',
                                'icon' => 'fas fa-fw fa-user',
                                

                            ],
                            [
                                'text' => 'Coinsults',
                                'url'  => 'coinsult',
                                'icon' => 'fas fa-fw fa-coins',
                                'label'       => 'i',
                                'label_color' => 'secondary',


                            ],
                             [
                                'text' => 'Guardados',
                                'url'  => 'gestion/articulo_user',
                                'icon' => 'fas fa-fw fa-bookmark',
                                'label'       => 'i ',
                                'label_color' => 'secondary',
                                'active' => ['gestion/search_user_art']

                            ],
                            [
                                'text' => 'Historial',
                                'url'  => 'actividades/historial',
                                'icon' => 'fas fa-fw fa-history ',
                                'label'       => 'nuevo',
                                'label_color' => 'success',
                                'active' => ['actividades/historial']
                            ],
                            [
                                'text' => 'Biblioteca virtual',
                                'url'  => 'biblioteca/show',
                                'icon' => 'fas fa-book-reader ',
                                'label'       => 'in process',
                                'label_color' => 'danger',
                                // 'active' => ['actividades/historial']
                            ],
                            
                            ['header' => 'Publicidad'],
                            [
                                'text' => 'Encuentra AQUÍ ',
                                'url'  => 'https://adminlte.io/themes/v3/index.html',
                                
                                'icon' => 'fas fa-fw fa-user',
                                'target' => '_blank' 
                            ],
                        );
                     }
                    if($consul=='dr'){
                        $event->menu->add(
                            [
                                'text' => 'Inicio',
                                'url'  => '/home',
                                'icon' => 'fas fa-fw fa-home',
                                'active' => ['gestion/search','medico/info*']
                                
                            ],
                            [
                                'text' => 'Perfil',
                                'url'  => '/medico/perfil',
                                'icon' => 'fas fa-fw fa-user',
                                'active' => ['medico/show']

                            ],
                            [
                                'text' => 'Coinsults',
                                'url'  => 'coinsult',
                                'icon' => 'fas fa-fw fa-coins',
                                'label'       => 'i',
                                'label_color' => 'primary',


                            ],
                             [
                                'text' => 'Guardados',
                                'url'  => 'gestion/articulo_user',
                                'icon' => 'fas fa-fw fa-bookmark',
                                'label'       => 'i ',
                                'label_color' => 'primary',
                                'active' => ['gestion/search_user_art']

                            ],
                            [
                                'text' => 'Repositorio',
                                'icon' => 'fas fa-archive',
                                'submenu' => [
                                               [
                                                   'text' => 'Buscar archivo',
                                                   'url'  => 'biblioteca/show',
                                               ],
                                               [
                                                   'text' => 'Guardar archivo',
                                                   'url'  => 'biblioteca/repositorio',
                                               ],
                                            ],
                            ],
                            [
                                'text' => 'Agregar Publicación',
                                'url'  => 'gestion/articulo',
                                'icon' => 'fas fa-fw fa-newspaper',
                                'active' => ['gestion/articulo']

                            ],
                            [
                                'text' => 'Ayudanos a ayudar',
                                'url'  => '/medico/casos_ex',
                                'icon' => 'fas fa-hands-helping',
                                'active' => ['gestion/caso*','gestion/search_caso','gestion/last_month']

                            ],
                            
                            ['header' => 'Publicidad'],
                            [
                                'text' => 'Servicios y productos',
                                'url'  => 'https://adminlte.io/themes/v3/index.html',
                                
                                'icon' => 'fas fa-fw fa-user',
                                'target' => '_blank' 
                            ],
                        );
                    }
                    if($consul=='em'){
                        // $event->menu->add(
                        //     [
                        //         'text' => 'Inicio',
                        //         'url'  => '/home',
                        //         'icon' => 'fas fa-fw fa-home',
                        //         'active' => ['gestion/articulo', 'doctor*']
                                
                        //     ],
                        //     [
                        //         'text' => 'Perfil',
                        //         'url'  => '/profile/perfil',
                        //         'icon' => 'fas fa-fw fa-user',
                                

                        //     ],
                        //     [
                        //         'text' => 'Coinsults',
                        //         'url'  => 'coinsult',
                        //         'icon' => 'fas fa-fw fa-coins',
                        //         'label'       => 'i',
                        //         'label_color' => 'primary',


                        //     ],
                        //      [
                        //         'text' => 'Guardados',
                        //         'url'  => 'gestion/articulo_user',
                        //         'icon' => 'fas fa-fw fa-bookmark',
                        //         'label'       => 'i ',
                        //         'label_color' => 'primary',
                        //         'active' => ['gestion/search_user_art']

                        //     ],
                            
                        //     ['header' => 'Publicidad'],
                        //     [
                        //         'text' => 'Encuentra AQUÍ ',
                        //         'url'  => 'https://adminlte.io/themes/v3/index.html',
                                
                        //         'icon' => 'fas fa-fw fa-user',
                        //         'target' => '_blank' 
                        //     ],
                        // ); 
                    }
                
            }else{
                $event->menu->add(
                            [
                                'text' => '¿Qué somos ?',
                                'url'  => '/login',
                                'icon' => 'fa fa-notes-medical',
                                'label'       => 'i ',
                                'label_color' => 'secondary',
                                'active' => ['gestion/articulo', 'doctor*']
                                
                            ],
                            [
                                'text' => 'Inicio',
                                'url'  => '/home',
                                'icon' => 'fas fa-fw fa-home',

                                'active' => ['gestion/articulo', 'doctor*']
                                
                            ],
                            [
                                'text' => 'Coinsults',
                                'url'  => '/home',
                                'icon' => 'fas fa-fw fa-coins',
                                'label'       => 'i ',
                                'label_color' => 'secondary',
                                'active' => ['gestion/articulo', 'doctor*']
                                
                            ],
                            [
                                'text' => 'Guardados',
                                'url'  => 'gestion/articulo_user',
                                'icon' => 'fas fa-fw fa-bookmark',
                                'label'       => 'i ',
                                'label_color' => 'secondary',
                                'active' => ['gestion/search_user_art']

                            ],
                        ); 
            }
            
        });

        parent::boot();

        //
    }
}
