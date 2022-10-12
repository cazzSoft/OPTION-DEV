<tr>
<td class="header">
<br>
<a href="{{ $url }}" style="display: inline-block;">

@if (trim($slot) === 'Laravel')
<span> esto img arriba 2</span>
{{-- <img src="{{asset('img/logo2.png')}}" class="logo" alt="Laravel Logo"> --}}
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
@else
<img src="{{asset('img/logo2.png')}}" class="logo" alt="Laravel Logo"> <br>
{{-- <img src="{{asset('img/personas.png')}}" class="icon-person" alt="personas-Logo-img"> --}}
{{-- {{ $slot }} --}}
@endif
	
</a>
</td>
</tr>
