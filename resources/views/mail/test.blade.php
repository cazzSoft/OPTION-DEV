@component('mail::message')
<h1 class="titulo1">Notificacion prueba</h1>

	
@component('mail::button', ['url' =>  'https://laravel.com/docs/5.4/pagination#basic-usage','color'=>'info'])
	Revisar detalles
@endcomponent
 
Gracias,<br>
{{ config('app.name') }}
@endcomponent

{{-- @component('mail::message')
# Order Shipped
 
Your order has been shipped!
 
@component('mail::button', ['url' => 'http://option2healt-devp.herokuapp.com/calendario/'])
View Order
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}