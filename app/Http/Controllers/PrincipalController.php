<?php

namespace App\Http\Controllers;

use App\ArticuloModel;
use App\CiudadModel;
use App\NoticiaModel;
use App\TipoUserModel;
use App\User;
use Illuminate\Http\Request;
class PrincipalController extends Controller
{

    // public function __construct()
    // {   
       
    //     $this->middleware('web2');
    // }

    public function index()
    {
        $articulo=ArticuloModel::inRandomOrder()->withCount(['like'])
                ->with(['medico','like'=>function($q){
                            $q->select(['*'])->get();
                    }])->where('tipo','N')->where('publicar','1')->where('estado','1')->take(16)->paginate(16);
        // creacion de lista de noticia para el sliders
        $listaNoticia=NoticiaModel::with('especialidad')->where('estado',1)->where('activo',1)->get();
        
        $listaNoticia=$listaNoticia->groupBy('idespecialidades'); 

        //lista medicos
        $tipo=TipoUserModel::where('abr','dr')->first();
        $list_top_medico=User::inRandomOrder()->where('idtipo_user',$tipo['idtipo_user'])->get();
       

        return view('home',['articulos'=>$articulo,'listaNoticia'=>$listaNoticia,'list_top_medico'=>$list_top_medico]); 
    }


  
    public function showRegistro()
    {
        $consul=CiudadModel::all();
        return view('auth.register',['ciudades'=>$consul]);
    }

    //informacion de loguin
    public function infoLogin()
    {
        return view('login-registro.info-login');
    }

    //informacion de loguin
    public function login_paciente()
    {
        $detalle='
                <ul class="list-group lead text-justify mr-5 mt-5 ml-4 p-2 mb-5">
                    <li>Encontrar al profesional de la salud indicado para ti y tus necesidades.</li>
                    <li>Conocer más acerca de la carrera y el perfil de tu médico mediante la visualización de sus publicaciones  informativas en el área de salud subidas en nuestra plataforma.</li>
                    <li>Mantenerte informado/a mediante el acceso a la información profesional y científica sobre temas de salud de tu interés.</li>
                    <li>Ganar CoinSsults e intercambiarlos por consultas médicas o incluso donarlos a un familiar o amigo</li>
                </ul>';

        $datos=[
                'icono'=>'<i class="fas fa-user-alt"></i>',
                'detalle'=>$detalle,
                'tipo'=>'P',
                'img'=>'<img class="img-fluid" src="/img/op2.svg" alt="Photo"> ',
                    
            ];  

        return view('login-registro.login',['data'=>$datos]);
    }

    //informacion de loguin medico
    public function login_medico()
    {
        $detalle='
                <ul class="list-group lead text-justify mr-5 mt-5 ml-4 p-2 mb-5">
                    <li>Posicionar tu carrera como médico especialsita y ofrecer tus servicios profesionales en nuestra plataforma.</li>
                    <li>Potenciar la relacion médico-paciente, mediante la cual el paciente conozca el perfil profesional y trayectoria laboral de su médico tratante.</li>
                    <li>Acceder a la promoción y publicidad gratuita o pautada dentro de la plataforma que te permitirá llegar a pacientes que realmente requieren de tus servicios médicos.</li>
                    <li>Expandir tu networking dentro de la comunidad de médicos profesionales.</li>
                    <li>Ser parte de nuestra red de crowdsourcing a fin de aprender, colaborar u obtener apoyo profesional en casos médicos especiales.</li>
                </ul>';

        $datos=[
                'icono'=>'<i class="fas fa-user-md"></i>',
                'detalle'=>$detalle,
                'img'=>'<img class="img-fluid" src="/img/op3.svg" alt="Photo"> ',
                'tipo'=>'M',
                    
            ];  

        return view('login-registro.login',['data'=>$datos]);
    }

    //informacion de loguin
    public function login_empresa()
    {
        $detalle='
                <ul class="list-group lead text-justify mr-5 mt-5 ml-4 p-2 mb-5">
                    <li>Posicionar tu marca empresarial y promocionar sus servicios y/o prodcutos de salud en nuestra plataforma.</li>
                    <li>Llegar a segmentos de mercado específicos y definidos de acuerdo a tendencias de salud de los usuarios y patrones de comportamientos, hábitos y perfiles clinicos. </li>
                    <li>Contactar con potenciales clientes.</li>
                    <li>Expandir su networking con difernetes empresas en el sector de la salud.</li>
                    <li>Contribuir en causas sociales que impacten positivamente en la salud de la sociedad.</li>
                </ul>';

        $datos=[
                'icono'=>'<i class="fas fa-briefcase-medical"></i>',
                'detalle'=>$detalle,
                'img'=>'<img class="img-fluid" src="/img/op4.svg" alt="Photo"> ',
                'tipo'=>'E',
                    
            ];  

        return view('login-registro.login',['data'=>$datos]);
    }

    //acerca de nosotros 
    public function aboutme()
    {
        $detalle='  <p class="lead ml-5 mr-5 p-3 text-justify">
                      <a href="/"> <b class="text-info">Option2health </b></a> es una plataforma de salud digital enfocada en la salud y educación para las personas que buscan prevenir o tratar enfermedades, y a la vez encontrar el médico idóneo que se acople a sus necesidades personales, permitiéndoles tomar el control sobre su salud y generar soluciones para enfrentar enfermedades y tener una mejor calidad de vida.</p>
                    <p class="lead ml-5 mr-5 p-3 text-justify">   
                       Además,  <a href="/"> <b class="text-info">Option2health </b></a> permite posicionar a médicos y empresas del sector de la salud registrados en la plataforma como expertos en su área mediante la difusión segmentada de contenido de valor digital.
                    </p>';
        $datos=['detalle'=>$detalle,
                'titulo'=>'Acerca de Nosotros',
                'tp'=>'AN',
                ];
        return view('login-registro.informacion',['data'=>$datos]);
    }

    //informacion del coinsul 
    public function info_coinsults()
    {   
        $detalle='  <div class="lead ml-5 mr-5 p-3 text-justify">
                        <dl>
                            <dt> ¿Sabes qué son los Coinsults?</dt>
                            <dd class="mb-3"> Son los puntos que ganas cada vez que interactúas con esta plataforma.</dd>
                            
                            <dt> Como PACIENTE, podrás obtener Coinsults de las siguientes maneras:</dt>
                            <dd>
                                <ul class="list">
                                    <li> Al crear tu cuenta en Option2health, ganarás automáticamente 5 Coinsults de bienvenida.</li>
                                    <li> Primer “Like” en una publicación de la plataforma de Option2health. </li>
                                    <li> Cada vez que respondes a una de nuestras preguntas en la plataforma, entre otras.</li> 
                                </ul>
                            </dd>
                            
                            <dt class="ml-3"> ¿Cómo podrás usar tus Coinsults?</dt>
                            <dd class="ml-3 mb-4 ">PRÓXIMAMENTE, tu salud mejorará gracias a los Coinsults que obtengas. Mientras más Coinsults acumules, mayores probabilidades tendrás de acceder a consultas médicas con tu médico preferido dentro de la plataforma, o incluso beneficiar a los miembros de tu familia o amigos, a quienes les puedas DONAR tus Coinsults y así apoyarlos en sus necesidades de salud.</dd>
                         
                            <dt> El MÉDICO, también podrá ganar Coinsults de las siguientes maneras:</dt>
                            <dd>
                                <ul class="mb-3 list">
                                    <li> Al crear tu cuenta en Option2health, ganarás automáticamente 5 Coinsults de bienvenida.</li>
                                    <li> Primer “Like” en una publicación de la plataforma de Option2health. </li>
                                    <li> Creación de contenido de valor para tus pacientes, entre otras.</li>
                                     
                                </ul>
                            </dd>
                          
                            <dt class="ml-3">¿Cómo podrás usar tus Coinsults?</dt>
                            <dd class="ml-3">Como MÉDICO, podrás canjear tus Coinsults acumulados por más publicaciones pautadas en nuestra plataforma y de esta manera llegar a más usuarios y potenciales pacientes que requieran de tus servicios.</dd>    
                        </dl> 
                    </div> ';
        $datos=['detalle'=>$detalle,
                'titulo'=>'Coinsults',
                'tp'=>'CO',
                ]; 
        
        return view('login-registro.informacion',['data'=>$datos]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
