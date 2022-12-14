<div class="row">
    <div class="col-sm-12">
      @if(isset($lista_seccion))
        @foreach($lista_seccion as $key=>$item_s)
          <dt>
            {{ $item_s->titulo}}
            <span class="text-info_ text-decoration  btn" onclick="traer_p('{{encrypt($item_s->idsecciones)}}','{{$key}}',this)" > <u>Ver más</u></span>
            <input type="hidden" id="seccion_{{$key}}">
          </dt> 

          {{--sub seccion preguntas  --}}
          <div class="row col-sm-12 seccion_{{$key}} d-none  @movil @else p-2 @endmovil" >
          </div>  

        @endforeach
      @endif
    </div>
</div>