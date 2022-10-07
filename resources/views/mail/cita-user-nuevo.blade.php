@component('mail::message')
  <h1 class="titulo1">Cita médica agendada</h1>
  <p class="parrafo1">
    Se ha agendado la cita “{{ $data['titulo'] }}”
  </p>
    
  <p class="titulo2 text-capitalize">{{$data['fecha']}} <br> <small>{{$data['hora']}}</small></p>
  @if(isset($data['lugar']))
  <div class="text-center" data-tooltip-align='a,d'>
  <span class="bacge">Modalidad precencial</span>
  </div>
  @else
  <div class="text-center" data-tooltip-align='a,d'>
  <span class="bacge">Modalidad virtual</span>
  </div>
  @endif
  <p class="parrafo1 ">{{$data['lugar']}} </p>

    
  @component('mail::button', ['url' => $url,'color'=>'info'])
    Revisar detalles
  @endcomponent


   
  <p class="parrafo1">
    Para acceder al resto de los detalles y visitar el perfil del Médico especialista, finaliza tu registro en nuestra plataforma 
    (<a href="https://www.option2health.com/">https://www.option2health.com/</a>):
  </p>
  <p  class="parrafo1">
    email: {{$data['email']}}  <br>
    contraseña temporal: {{$data['password']}}
  </p>
  <p class="parrafo1">Recuerda, debes cambiar la contraseña una vez ingresado en la plataforma.</p>


  Gracias,<br>
  {{ config('app.name') }}
@endcomponent