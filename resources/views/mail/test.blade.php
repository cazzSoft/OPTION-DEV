{{-- @component('mail::message')
<h1 class="titulo1">Notificacion prueba</h1>
<img src="{{asset('img/personas.png')}}" class="icon-person test" alt="personas-Logo-img">
	
@component('mail::button', ['url' =>  'https://laravel.com/docs/5.4/pagination#basic-usage','color'=>'info'])
	Revisar detalles
@endcomponent
 
Gracias,<br>
{{ config('app.name') }}
@endcomponent --}}

@component('mail::message')
# Order Shipped
 
Your order has been shipped!
 
@component('mail::button', ['url' => $url])
View Order
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent