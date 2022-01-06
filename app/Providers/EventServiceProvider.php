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
            SendEmailVerificationNotification::class,
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
