@component('mail::message')
<h1 class="titulo1">Tienes una cita nueva</h1>
<p class="parrafo1">
	@if(isset($data['titulo']))
		{{$data['titulo']}}
	@endif
</p>	
<p class="titulo2 text-capitalize">{{$data['fecha']}} <br> <small>{{$data['hora']}}</small> <br> <small>{{$data['telefono']}}</small> </p>


<p class="parrafo1">Recuerda conectarte e iniciar la cita para poder atender al paciente. </p>


	
@component('mail::button', ['url' =>  $url.'/calendario','color'=>'info'])
	Revisar cita
@endcomponent
 

<p class="parrafo1"><small>Para atender la cita usa este link</small></p>
<p class="parrafo1"><a href="{{$url.'/calendario'}}">(<u>{{$url.'/calendario'}}</u>)</a></p>



<br>
{{ config('app.name') }}
@endcomponent