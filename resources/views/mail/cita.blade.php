@component('mail::message')
<h1 class="titulo1">Cita médica agendada</h1>
<p class="parrafo1">
	@if(isset($data['titulo']))
	Se ha agendado la cita “{{$data['titulo']}}”
	@endif
</p>	
<p class="titulo2 text-capitalize">{{$data['fecha']}} <br> <small>{{$data['hora']}}</small> </p>
@if(isset($data['lugar']))
<div class="text-center" data-tooltip-align='a,d'>
	<span class="bacge">Modalidad precencial</span>
</div>
@else
<div class="text-center" data-tooltip-align='a,d'>
	<span class="bacge">Modalidad virtual</span>
</div>
@endif
<p class="parrafo1">{{$data['lugar']}} </p>


	
@component('mail::button', ['url' =>  $url.'profile/perfil','color'=>'info'])
	Revisar detalles
@endcomponent
 

Gracias,<br>
{{ config('app.name') }}
@endcomponent