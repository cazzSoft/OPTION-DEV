@component('mail::message')
<h1 class="titulo1 text-danger">Cita médica cancelada</h1>
<p class="parrafo1 alert-error">
	Este evento se ha cancelado y eliminado del calendario “{{$data['titulo']}}”
</p>	
<p class="titulo2 text-capitalize">{{$data['fecha']}}</p>
<p class="parrafo1">{{$data['lugar']}}</p>

 

Gracias,<br>
{{ config('app.name') }}
@endcomponent